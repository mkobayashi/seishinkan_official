#!/usr/bin/env bash
set -euo pipefail

# lolipop (production) sync via SFTP using lftp mirror.
#
# Required env:
# - LOLIPOP_HOST (e.g. ftp.lolipop.jp)
# - LOLIPOP_USER (e.g. main.jp-cs-akasaka)
# - LOLIPOP_PASS
# - LOLIPOP_REMOTE_DIR (remote deploy root, e.g. /home/users/.../web/seishinkan )
#
# Optional env:
# - DRY_RUN=1 (prints changes; no uploads)

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

: "${LOLIPOP_HOST:?}"
: "${LOLIPOP_USER:?}"
: "${LOLIPOP_PASS:?}"
: "${LOLIPOP_REMOTE_DIR:?}"

DRY_RUN="${DRY_RUN:-0}"

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
  "--only-newer"
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

echo "Syncing to lolipop: sftp://${LOLIPOP_USER}@${LOLIPOP_HOST}${LOLIPOP_REMOTE_DIR}"

for item in "${INCLUDES[@]}"; do
  if [[ -d "${ROOT_DIR}/${item}" ]]; then
    SRC_PATH="${ROOT_DIR}/${item}"
    DST_PATH="${LOLIPOP_REMOTE_DIR}/${item%/}"
  else
    SRC_PATH="${ROOT_DIR}/${item}"
    DST_PATH="${LOLIPOP_REMOTE_DIR}"
  fi

  lftp -u "${LOLIPOP_USER}","${LOLIPOP_PASS}" "sftp://${LOLIPOP_HOST}" -e "set sftp:auto-confirm yes; set net:timeout 20; set net:max-retries 2; set ssl:verify-certificate no; mirror ${LFTP_MIRROR_FLAGS[*]} \"${SRC_PATH}\" \"${DST_PATH}\"; bye"
done

echo "Done."

