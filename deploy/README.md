## deploy（ステージング / 本番）

このプロジェクトは `heteml`（ステージング）と `ロリポップ`（本番）に対して、**SFTPで差分同期**する運用を想定します。

### heteml（ステージング）へ同期（手動）

`lftp` が必要です。

```bash
brew install lftp
```

実行例:

```bash
cd /Users/kobayashimasahiro/Desktop/seishinkan_official

export HETEML_HOST="ftp-aikidodev.heteml.net"
export HETEML_USER="aikidodev"
export HETEML_PASS="(SFTPのパスワード)"
export HETEML_REMOTE_DIR="/web/seishinkan_official"

bash deploy/heteml_sync.sh
```

差分確認だけしたい場合:

```bash
DRY_RUN=1 bash deploy/heteml_sync.sh
```

### GitHub Actions（自動）

`.github/workflows/deploy-heteml.yml` を参照してください。Secrets の登録が必要です。

### lolipop（本番）へ同期（手動実行）

本番は事故防止のため **workflow_dispatch（手動実行）** にしています。

Secrets（GitHub Actions）:

- `LOLIPOP_HOST`（例: `ftp.lolipop.jp`）
- `LOLIPOP_USER`（例: `main.jp-cs-akasaka`）
- `LOLIPOP_PASS`
- `LOLIPOP_REMOTE_DIR`（本番でこのプロジェクトを配置しているディレクトリ）

ワークフロー:

- `.github/workflows/deploy-lolipop.yml`

ローカルから手動で差分確認だけする場合:

```bash
cd /Users/kobayashimasahiro/Desktop/seishinkan_official

export LOLIPOP_HOST="ftp.lolipop.jp"
export LOLIPOP_USER="main.jp-cs-akasaka"
export LOLIPOP_PASS="(SFTPのパスワード)"
export LOLIPOP_REMOTE_DIR="(例: /home/users/.../web/seishinkan )"

DRY_RUN=1 bash deploy/lolipop_sync.sh
```

