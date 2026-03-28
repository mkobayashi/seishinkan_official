#!/usr/bin/env bash
set -euo pipefail

# heteml (staging) sync via lftp mirror (FTP or FTPS).
#
# Required env:
# - HETEML_HOST (e.g. ftp-aikidodev.heteml.net)
# - HETEML_USER (e.g. aikidodev)
# - HETEML_PASS
# - HETEML_REMOTE_DIR (e.g. /root/web/seishinkan_official)
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

run_lftp_mirror() {
  local src_path="$1"
  local dst_path="$2"
  {
    lftp_settings
    echo "open ${OPEN_URL}"
    echo "mirror ${LFTP_MIRROR_FLAGS[*]} \"${src_path}\" \"${dst_path}\""
    echo "bye"
  } | lftp
}

# mirror はディレクトリ向け。単一ファイルは put（「Not a directory」回避）
run_lftp_put() {
  local src_file="$1"
  local remote_dir="$2"
  local base
  base="$(basename "$src_file")"
  if [[ "${DRY_RUN}" == "1" ]]; then
    echo "[dry-run] put \"${src_file}\" -> ${remote_dir}/${base}"
    return
  fi
  {
    lftp_settings
    echo "open ${OPEN_URL}"
    echo "cd \"${remote_dir}\""
    echo "put \"${src_file}\" -o \"${base}\""
    echo "bye"
  } | lftp
}

echo "Syncing to heteml (${HETEML_FTP_MODE}): ftp://${HETEML_USER}@${HETEML_HOST}${HETEML_REMOTE_DIR}"

for item in "${INCLUDES[@]}"; do
  LOCAL_PATH="${ROOT_DIR}/${item}"
  if [[ -d "${LOCAL_PATH}" ]]; then
    run_lftp_mirror "${LOCAL_PATH}" "${HETEML_REMOTE_DIR}/${item%/}"
  elif [[ -f "${LOCAL_PATH}" ]]; then
    run_lftp_put "${LOCAL_PATH}" "${HETEML_REMOTE_DIR}"
  else
    echo "Error: include not found: ${item}" >&2
    exit 1
  fi
done

echo "Done."
