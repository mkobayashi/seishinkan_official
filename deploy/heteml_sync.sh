#!/usr/bin/env bash
set -euo pipefail

# heteml (staging) sync via FTPS (FTP over TLS) using lftp mirror.
#
# Required env:
# - HETEML_HOST (e.g. ftp-aikidodev.heteml.net)
# - HETEML_USER (e.g. aikidodev)
# - HETEML_PASS
# - HETEML_REMOTE_DIR (e.g. /root/web/seishinkan_official)
#
# Optional env:
# - DRY_RUN=1 (prints commands; no changes)

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

: "${HETEML_HOST:?}"
: "${HETEML_USER:?}"
: "${HETEML_PASS:?}"
: "${HETEML_REMOTE_DIR:?}"

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

TMP_INCLUDE_FILE="$(mktemp)"
trap 'rm -f "${TMP_INCLUDE_FILE}"' EXIT

for item in "${INCLUDES[@]}"; do
  echo "${item}" >> "${TMP_INCLUDE_FILE}"
done

echo "Syncing to heteml: ftps://${HETEML_USER}@${HETEML_HOST}${HETEML_REMOTE_DIR}"

# lftp include file format: `--include-glob-from` is supported by lftp mirror.
# We'll run one mirror per include entry to keep behavior predictable.
for item in "${INCLUDES[@]}"; do
  if [[ -d "${ROOT_DIR}/${item}" ]]; then
    SRC_PATH="${ROOT_DIR}/${item}"
    DST_PATH="${HETEML_REMOTE_DIR}/${item%/}"
  else
    SRC_PATH="${ROOT_DIR}/${item}"
    DST_PATH="${HETEML_REMOTE_DIR}"
  fi

  lftp -u "${HETEML_USER}","${HETEML_PASS}" "ftp://${HETEML_HOST}" -e "set ftp:ssl-force true; set ftp:ssl-protect-data true; set ssl:verify-certificate no; set net:timeout 20; set net:max-retries 2; mirror ${LFTP_MIRROR_FLAGS[*]} \"${SRC_PATH}\" \"${DST_PATH}\"; bye"
done

echo "Done."

