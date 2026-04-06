## deploy（ステージング / 本番）

このプロジェクトは `heteml`（ステージング）と `ロリポップ`（本番）に対して、**lftp で差分同期**する運用を想定します（heteml: FTP/FTPS、本番ロリポップ: **既定は FTPS**／必要なら SFTP）。

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

#### SSH 未契約・管理画面に「SFTP」と書いていない場合

**問題ありません。** ロリポップの **FTP / FTPS**（接続先 `ftp.lolipop.jp`）だけでファイル転送できます。シェルにログインする「SSH」と、転送プロトコル名としての「SFTP」は別です。プランによっては SFTP という語が出ず、FTPS だけの案内になっていることもあります。

- **自動デプロイ**: `deploy/lolipop_sync.sh` の既定は **`LOLIPOP_TRANSFER_MODE=ftps`**（TLS 付き FTP）です。GitHub Actions のワークフローも `ftps` 固定です。
- **手動で上書き**: もちろん可能です。FileZilla 等で **FTPS** 接続し、`lolipop_sync.sh` の `INCLUDES` と同じフォルダ・ファイルをリモートの `LOLIPOP_REMOTE_DIR` 配下に上げれば同じ結果になります。WordPress テーマは `wp/wp-content/themes/seishinkan/` も別途アップロードが必要です（同期スクリプトは `wp/` を含めていません）。テーマの `header.php` / `footer.php` は **サイトルートの `templates/header.php` と `templates/footer.php` を読み込む**ため、本番でも **`templates/` と `wp/` が同じ公開ルート配下**にある必要があります。

Secrets（GitHub Actions）:

- `LOLIPOP_HOST`（**FTPS 既定**: `ftp.lolipop.jp`。SSH/SFTP を別途使う場合のみ `ssh.lolipop.jp` 等）
- `LOLIPOP_USER`（FTP ユーザー名）
- `LOLIPOP_PASS`（FTP パスワード）
- `LOLIPOP_REMOTE_DIR`（本番でこのプロジェクトを置いているディレクトリ）

#### `LOLIPOP_REMOTE_DIR` がずれていると「更新されない」

管理画面や `http://（アカウント）.main.jp/seishinkan/` で見えている **いまサイトが動いているフォルダ**と、デプロイ先が**同じ物理ディレクトリ**である必要があります。

- 例: 公開が `…/web/seishinkan/` なのに、Actions の Secret が `…/web` だけだと、`class/` や `templates/` が **隣の階層に上がり**、`seishinkan.org` では **古い `header.php` / `footer.php` のまま**に見えます。
- FTP で `templates/header.php` を直したつもりでも、**別パス**の同名ファイルを触っていると反映されません。ロリポップの「公開フォルダ」表示のパスと Secret を突き合わせてください。

転送モード（`deploy/lolipop_sync.sh`）:

| `LOLIPOP_TRANSFER_MODE` | 用途 |
|-------------------------|------|
| `ftps`（既定） | **FTPS**・`ftp.lolipop.jp`（SSH 不要） |
| `ftp` | 平文 FTP（非推奨） |
| `sftp` | SSH 利用プランで **SFTP** する場合（例: `ssh.lolipop.jp`・ポート `2222`） |

管理画面の種別との対応:

| 種別 | ホスト例 | スクリプト |
|------|-----------|------------|
| **FTPS（推奨）** | `ftp.lolipop.jp` | `LOLIPOP_TRANSFER_MODE=ftps`（既定） |
| FTP（平文） | `ftp.lolipop.jp` | `LOLIPOP_TRANSFER_MODE=ftp` |
| SFTP | `ssh.lolipop.jp` 等 | `LOLIPOP_TRANSFER_MODE=sftp` と `LOLIPOP_SFTP_PORT` |
| WebDAV | `https://….webdav-lolipop.jp/` | 本スクリプトでは未使用（クライアントで手動可） |

公式: [FTPの利用方法](https://lolipop.jp/manual/user/ftp2-01/) など。

ワークフロー: `.github/workflows/deploy-lolipop.yml`（`LOLIPOP_TRANSFER_MODE: ftps`）

ローカルから実行・ドライラン例（FTPS）:

```bash
cd /Users/kobayashimasahiro/Desktop/seishinkan_official

export LOLIPOP_TRANSFER_MODE=ftps
export LOLIPOP_HOST="ftp.lolipop.jp"
export LOLIPOP_USER="(FTPユーザー)"
export LOLIPOP_PASS="(FTPパスワード)"
export LOLIPOP_REMOTE_DIR="/home/users/.../web/seishinkan"

DRY_RUN=1 bash deploy/lolipop_sync.sh
```

#### `mirror: Fatal error: max-retries exceeded`（GitHub Actions など）

接続が不安定・拒否されているときに出ます。スクリプトはタイムアウト延長・並列 1 などを入れています。あわせて次を確認してください。

- **FTPS なら** `LOLIPOP_HOST=ftp.lolipop.jp`、**SFTP なら** `ssh.lolipop.jp` とモードの組み合わせが正しいか
- **FTP アクセス制限**（特定 IP のみ許可）を有効にしていると、GitHub Actions からは繋がりません。制限を見直すか、**手元から `bash deploy/lolipop_sync.sh`**、またはセルフホストランナーを使う

任意の環境変数（デフォルトは括弧内）:

- `LOLIPOP_FTP_MODE`（`ftps-force` / `ftps-allow` / `plain` — FTPS で 530 等のとき `ftps-allow` を試す）
- `LOLIPOP_SFTP_PORT`（sftp のみ、既定 `22`）
- `LOLIPOP_NET_TIMEOUT`（秒、`60`）
- `LOLIPOP_NET_MAX_RETRIES`（`20`）
- `LOLIPOP_PARALLEL`（`1`）

