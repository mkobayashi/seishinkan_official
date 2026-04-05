#!/usr/bin/env bash
set -euo pipefail

# lolipop (production) sync via lftp mirror.
#
# SSH 未契約でも使えるよう、既定は FTPS（ftp.lolipop.jp）です。
#
# Required env:
# - LOLIPOP_HOST（FTPS: ftp.lolipop.jp / SFTP: ssh.lolipop.jp 等）
# - LOLIPOP_USER
# - LOLIPOP_PASS
# - LOLIPOP_REMOTE_DIR（リモートの公開ルート。末尾スラッシュは自動除去）
#
# Optional env:
# - LOLIPOP_TRANSFER_MODE
#     ftps   (default) FTP over TLS — 管理画面の FTPS / ftp.lolipop.jp
#     ftp    平文 FTP（非推奨・接続先が許可している場合のみ）
#     sftp   SSH/SFTP 契約がある場合（ssh.lolipop.jp:2222 等）
# - LOLIPOP_FTP_MODE（FTPS/FTP 時のみ、heteml と同じ）
#     ftps-force | ftps-allow | plain
# - DRY_RUN=1
# - LOLIPOP_SFTP_PORT（sftp のみ、default: 22）
# - LOLIPOP_NET_TIMEOUT（default: 60）
# - LOLIPOP_NET_MAX_RETRIES（default: 20）
# - LOLIPOP_PARALLEL mirror 並列（default: 1）

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

lolipop_require_env() {
  local missing=()
  [[ -z "${LOLIPOP_HOST:-}" ]] && missing+=(LOLIPOP_HOST)
  [[ -z "${LOLIPOP_USER:-}" ]] && missing+=(LOLIPOP_USER)
  [[ -z "${LOLIPOP_PASS:-}" ]] && missing+=(LOLIPOP_PASS)
  [[ -z "${LOLIPOP_REMOTE_DIR:-}" ]] && missing+=(LOLIPOP_REMOTE_DIR)
  if ((${#missing[@]})); then
    echo "lolipop_sync.sh: 次の環境変数が空です: ${missing[*]}" >&2
    echo "  GitHub Actions: Settings → Secrets and variables → Actions" >&2
    exit 1
  fi
}
lolipop_require_env

LOLIPOP_TRANSFER_MODE="${LOLIPOP_TRANSFER_MODE:-ftps}"
LOLIPOP_REMOTE_DIR="${LOLIPOP_REMOTE_DIR%/}"

DRY_RUN="${DRY_RUN:-0}"
LOLIPOP_SFTP_PORT="${LOLIPOP_SFTP_PORT:-22}"
LOLIPOP_NET_TIMEOUT="${LOLIPOP_NET_TIMEOUT:-60}"
LOLIPOP_NET_MAX_RETRIES="${LOLIPOP_NET_MAX_RETRIES:-20}"
LOLIPOP_PARALLEL="${LOLIPOP_PARALLEL:-1}"

if [[ "${LOLIPOP_TRANSFER_MODE}" == "sftp" && "${LOLIPOP_HOST}" == *ftp.lolipop.jp* ]]; then
  echo "lolipop_sync.sh: 警告: SFTP モードなのに LOLIPOP_HOST が ftp.lolipop.jp です。" >&2
  echo "  SSH/SFTP 利用時は ssh.lolipop.jp とポート 2222 が一般的です。FTPS のみなら LOLIPOP_TRANSFER_MODE=ftps を使ってください。" >&2
fi
if [[ "${LOLIPOP_TRANSFER_MODE}" == "ftps" && "${LOLIPOP_HOST}" == ssh.lolipop.jp ]]; then
  echo "lolipop_sync.sh: 警告: FTPS モードなのに LOLIPOP_HOST が ssh.lolipop.jp です。通常は ftp.lolipop.jp です。" >&2
fi

INCLUDES=(
  "about/"
  "class/"
  "css/"
  "en/"
  "entry/"
  "fonts/"
  "guidance/"
  "image/"
  "js/"
  "templates/"
  ".htaccess"
  "index.php"
  "favicon.ico"
  "favicon-16x16.png"
  "favicon-32x32.png"
  "apple-touch-icon.png"
  "android-chrome-192x192.png"
  "android-chrome-256x256.png"
  "browserconfig.xml"
)

LFTP_MIRROR_FLAGS=(
  "--reverse"
  "--verbose"
  "--parallel=${LOLIPOP_PARALLEL}"
  "--no-perms"
  "--no-umask"
  "--exclude-glob" ".git/**"
  "--exclude-glob" ".github/**"
  "--exclude-glob" "deploy/**"
  "--exclude-glob" "wp/**"
)

if [[ "${DRY_RUN}" == "1" ]]; then
  LFTP_MIRROR_FLAGS+=("--dry-run")
fi

lolipop_lftp_preamble_sftp() {
  cat <<EOF
set sftp:auto-confirm yes
set net:timeout ${LOLIPOP_NET_TIMEOUT}
set net:max-retries ${LOLIPOP_NET_MAX_RETRIES}
set net:reconnect-interval-base 5
set net:reconnect-interval-multiplier 1
set ssl:verify-certificate no
set sftp:connect-program "ssh -a -x -o BatchMode=yes -o StrictHostKeyChecking=accept-new -o ConnectTimeout=30"
EOF
}

# --- SFTP ---
lolipop_sync_sftp() {
  if [[ "${LOLIPOP_SFTP_PORT}" == "22" ]]; then
    SFTP_TARGET="sftp://${LOLIPOP_HOST}"
  else
    SFTP_TARGET="sftp://${LOLIPOP_HOST}:${LOLIPOP_SFTP_PORT}"
  fi

  echo "Syncing (sftp): ${SFTP_TARGET} → ${LOLIPOP_REMOTE_DIR} (parallel=${LOLIPOP_PARALLEL})"

  local LFTP_SCRIPT
  LFTP_SCRIPT="$(mktemp)"
  trap 'rm -f "${LFTP_SCRIPT}"' EXIT

  for item in "${INCLUDES[@]}"; do
    local LOCAL_PATH="${ROOT_DIR}/${item}"
    if [[ -d "${LOCAL_PATH}" ]]; then
      local SRC_PATH="${LOCAL_PATH}"
      local DST_PATH="${LOLIPOP_REMOTE_DIR}/${item%/}"
      {
        lolipop_lftp_preamble_sftp
        echo "open -u \"${LOLIPOP_USER}\",\"${LOLIPOP_PASS}\" ${SFTP_TARGET}"
        echo "mirror ${LFTP_MIRROR_FLAGS[*]} \"${SRC_PATH}\" \"${DST_PATH}\""
        echo "bye"
      } >"${LFTP_SCRIPT}"
      lftp -f "${LFTP_SCRIPT}"
    elif [[ -f "${LOCAL_PATH}" ]]; then
      local base
      base="$(basename "${LOCAL_PATH}")"
      if [[ "${DRY_RUN}" == "1" ]]; then
        echo "[dry-run] put \"${LOCAL_PATH}\" -> ${LOLIPOP_REMOTE_DIR}/${base}"
      else
        {
          lolipop_lftp_preamble_sftp
          echo "open -u \"${LOLIPOP_USER}\",\"${LOLIPOP_PASS}\" ${SFTP_TARGET}"
          echo "cd \"${LOLIPOP_REMOTE_DIR}\""
          echo "put \"${LOCAL_PATH}\" -o \"${base}\""
          echo "bye"
        } >"${LFTP_SCRIPT}"
        lftp -f "${LFTP_SCRIPT}"
      fi
    else
      echo "Error: include not found: ${item}" >&2
      exit 1
    fi
  done

  if [[ -f "${ROOT_DIR}/css/seishinkan.css" && "${DRY_RUN}" != "1" ]]; then
    echo "Force-upload css/seishinkan.css"
    {
      lolipop_lftp_preamble_sftp
      echo "open -u \"${LOLIPOP_USER}\",\"${LOLIPOP_PASS}\" ${SFTP_TARGET}"
      echo "cd \"${LOLIPOP_REMOTE_DIR}/css\""
      echo "put \"${ROOT_DIR}/css/seishinkan.css\" -o \"seishinkan.css\""
      echo "bye"
    } >"${LFTP_SCRIPT}"
    lftp -f "${LFTP_SCRIPT}"
  fi
}

# --- FTPS / 平文 FTP（SSH 不要）---
lolipop_open_url_ftp() {
  LOLIPOP_USER="${LOLIPOP_USER}" LOLIPOP_PASS="${LOLIPOP_PASS}" LOLIPOP_HOST="${LOLIPOP_HOST}" python3 - <<'PY'
import os, urllib.parse
u = urllib.parse.quote(os.environ["LOLIPOP_USER"], safe="")
p = urllib.parse.quote(os.environ["LOLIPOP_PASS"], safe="")
h = os.environ["LOLIPOP_HOST"]
print(f"ftp://{u}:{p}@{h}")
PY
}

lolipop_lftp_ftp_settings() {
  echo "set net:timeout ${LOLIPOP_NET_TIMEOUT}"
  echo "set net:max-retries ${LOLIPOP_NET_MAX_RETRIES}"
  echo "set net:reconnect-interval-base 5"
  echo "set ssl:verify-certificate no"
  case "${LOLIPOP_FTP_MODE}" in
    ftps-force)
      echo "set ftp:ssl-allow yes"
      echo "set ftp:ssl-force yes"
      echo "set ftp:ssl-protect-data yes"
      ;;
    ftps-allow)
      echo "set ftp:ssl-allow yes"
      echo "set ftp:ssl-force no"
      echo "set ftp:ssl-protect-data yes"
      ;;
    plain)
      echo "set ftp:ssl-allow no"
      ;;
    *)
      echo "Unknown LOLIPOP_FTP_MODE=${LOLIPOP_FTP_MODE}" >&2
      exit 1
      ;;
  esac
}

lolipop_run_ftp_mirror() {
  local src_path="$1"
  local remote_reldir="$2"
  local open_url
  open_url="$(lolipop_open_url_ftp)"
  if [[ "${DRY_RUN}" == "1" ]]; then
    echo "[dry-run] cd \"${LOLIPOP_REMOTE_DIR}\" && mirror ... \"${src_path}\" \"${remote_reldir}\""
    return
  fi
  {
    lolipop_lftp_ftp_settings
    echo "open ${open_url}"
    echo "cd \"${LOLIPOP_REMOTE_DIR}\""
    echo "mirror ${LFTP_MIRROR_FLAGS[*]} \"${src_path}\" \"${remote_reldir}\""
    echo "bye"
  } | lftp
}

lolipop_run_ftp_put() {
  local src_file="$1"
  local remote_subdir="${2:-}"
  local base
  base="$(basename "${src_file}")"
  local open_url
  open_url="$(lolipop_open_url_ftp)"
  if [[ "${DRY_RUN}" == "1" ]]; then
    if [[ -n "${remote_subdir}" ]]; then
      echo "[dry-run] cd \"${LOLIPOP_REMOTE_DIR}\" && cd \"${remote_subdir}\" && put \"${src_file}\" -o \"${base}\""
    else
      echo "[dry-run] cd \"${LOLIPOP_REMOTE_DIR}\" && put \"${src_file}\" -o \"${base}\""
    fi
    return
  fi
  {
    lolipop_lftp_ftp_settings
    echo "open ${open_url}"
    echo "cd \"${LOLIPOP_REMOTE_DIR}\""
    if [[ -n "${remote_subdir}" ]]; then
      echo "cd \"${remote_subdir}\""
    fi
    echo "put \"${src_file}\" -o \"${base}\""
    echo "bye"
  } | lftp
}

lolipop_sync_ftp() {
  LOLIPOP_FTP_MODE="${LOLIPOP_FTP_MODE:-ftps-force}"
  if [[ "${LOLIPOP_TRANSFER_MODE}" == "ftp" ]]; then
    LOLIPOP_FTP_MODE="plain"
  fi

  echo "Syncing (${LOLIPOP_TRANSFER_MODE} / ${LOLIPOP_FTP_MODE}): ftp://${LOLIPOP_USER}@${LOLIPOP_HOST} → cd ${LOLIPOP_REMOTE_DIR}"

  for item in "${INCLUDES[@]}"; do
    local LOCAL_PATH="${ROOT_DIR}/${item}"
    if [[ -d "${LOCAL_PATH}" ]]; then
      lolipop_run_ftp_mirror "${LOCAL_PATH}" "${item%/}"
    elif [[ -f "${LOCAL_PATH}" ]]; then
      lolipop_run_ftp_put "${LOCAL_PATH}" ""
    else
      echo "Error: include not found: ${item}" >&2
      exit 1
    fi
  done

  if [[ -f "${ROOT_DIR}/css/seishinkan.css" ]]; then
    echo "Force-upload css/seishinkan.css"
    lolipop_run_ftp_put "${ROOT_DIR}/css/seishinkan.css" "css"
  fi
}

case "${LOLIPOP_TRANSFER_MODE}" in
  sftp) lolipop_sync_sftp ;;
  ftps | ftp) lolipop_sync_ftp ;;
  *)
    echo "Unknown LOLIPOP_TRANSFER_MODE=${LOLIPOP_TRANSFER_MODE} (use ftps, ftp, or sftp)" >&2
    exit 1
    ;;
esac

echo "Done."
