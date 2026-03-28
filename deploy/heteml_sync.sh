#!/usr/bin/env bash
set -euo pipefail

# heteml (staging) sync via lftp mirror (FTP or FTPS).
#
# Required env:
# - HETEML_HOST (e.g. ftp-aikidodev.heteml.net)
# - HETEML_USER (e.g. aikidodev)
# - HETEML_PASS
# - HETEML_REMOTE_DIR  heteml 管理画面の「公開フォルダ」と完全一致（例: /web/seishinkan_official）
#   GitHub Secret も同じ値にすること。/root/web/... は別パスになるため使わない。
#
# Optional env:
# - DRY_RUN=1 (prints commands; no changes)
# - HETEML_FTP_MODE
#     ftps-force   (default) FTP over TLS, ssl-force
#     ftps-allow   TLS許可・強制なし（530切り分け）
#     plain        平文FTP（接続先が許可している場合のみ）

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

: "${HETEML_HOST:?}"
: "${HETEML_USER:?}"
: "${HETEML_PASS:?}"
: "${HETEML_REMOTE_DIR:?}"

# 末尾スラッシュを除去（cd / mirror の相対パス指定を安定させる）
HETEML_REMOTE_DIR="${HETEML_REMOTE_DIR%/}"

DRY_RUN="${DRY_RUN:-0}"
HETEML_FTP_MODE="${HETEML_FTP_MODE:-ftps-force}"

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
  # --only-newer は「リモートの mtime が新しい」と中身が古くてもスキップするため使わない
  "--parallel=4"
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

# ユーザー名・パスワードに記号があっても壊れにくいよう URL エンコード
heteml_open_url() {
  HETEML_USER="${HETEML_USER}" HETEML_PASS="${HETEML_PASS}" HETEML_HOST="${HETEML_HOST}" python3 - <<'PY'
import os, urllib.parse
u = urllib.parse.quote(os.environ["HETEML_USER"], safe="")
p = urllib.parse.quote(os.environ["HETEML_PASS"], safe="")
h = os.environ["HETEML_HOST"]
print(f"ftp://{u}:{p}@{h}")
PY
}

OPEN_URL="$(heteml_open_url)"

lftp_settings() {
  echo "set net:timeout 30"
  echo "set net:max-retries 5"
  echo "set ssl:verify-certificate no"
  case "${HETEML_FTP_MODE}" in
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
      echo "Unknown HETEML_FTP_MODE=${HETEML_FTP_MODE}" >&2
      exit 1
      ;;
  esac
}

# 公開フォルダへ cd したうえで、remote 側は相対パス（例: css）のみ指定する
run_lftp_mirror() {
  local src_path="$1"
  local remote_reldir="$2"
  if [[ "${DRY_RUN}" == "1" ]]; then
    echo "[dry-run] cd \"${HETEML_REMOTE_DIR}\" && mirror ... \"${src_path}\" \"${remote_reldir}\""
    return
  fi
  {
    lftp_settings
    echo "open ${OPEN_URL}"
    echo "cd \"${HETEML_REMOTE_DIR}\""
    echo "mirror ${LFTP_MIRROR_FLAGS[*]} \"${src_path}\" \"${remote_reldir}\""
    echo "bye"
  } | lftp
}

# mirror はディレクトリ向け。単一ファイルは put（「Not a directory」回避）
# remote_subdir が空なら公開フォルダ直下へ、例: css なら cd 公開フォルダ後に cd css
run_lftp_put() {
  local src_file="$1"
  local remote_subdir="${2:-}"
  local base
  base="$(basename "$src_file")"
  if [[ "${DRY_RUN}" == "1" ]]; then
    if [[ -n "${remote_subdir}" ]]; then
      echo "[dry-run] cd \"${HETEML_REMOTE_DIR}\" && cd \"${remote_subdir}\" && put \"${src_file}\" -o \"${base}\""
    else
      echo "[dry-run] cd \"${HETEML_REMOTE_DIR}\" && put \"${src_file}\" -o \"${base}\""
    fi
    return
  fi
  {
    lftp_settings
    echo "open ${OPEN_URL}"
    echo "cd \"${HETEML_REMOTE_DIR}\""
    if [[ -n "${remote_subdir}" ]]; then
      echo "cd \"${remote_subdir}\""
    fi
    echo "put \"${src_file}\" -o \"${base}\""
    echo "bye"
  } | lftp
}

echo "Syncing to heteml (${HETEML_FTP_MODE}): ftp://${HETEML_USER}@${HETEML_HOST} → cd ${HETEML_REMOTE_DIR}"

for item in "${INCLUDES[@]}"; do
  LOCAL_PATH="${ROOT_DIR}/${item}"
  if [[ -d "${LOCAL_PATH}" ]]; then
    run_lftp_mirror "${LOCAL_PATH}" "${item%/}"
  elif [[ -f "${LOCAL_PATH}" ]]; then
    run_lftp_put "${LOCAL_PATH}" ""
  else
    echo "Error: include not found: ${item}" >&2
    exit 1
  fi
done

# mirror がリモート日付等でスキップする事例があるため、氣圧法ページ用の本体を毎回 put で確実に上書き
if [[ -f "${ROOT_DIR}/css/seishinkan.css" ]]; then
  echo "Force-upload css/seishinkan.css"
  run_lftp_put "${ROOT_DIR}/css/seishinkan.css" "css"
fi

echo "Done."
