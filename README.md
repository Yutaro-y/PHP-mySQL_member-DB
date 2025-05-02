# WebApp_member-db

会員管理用のPHP＋MySQLアプリです。

# 環境構成
OS : Ubuntu24.04 LTS
DB : mySQL version: 

## ディレクトリ構成

- `frontend/` - Webサーバ用
- `backend/`  - DBサーバ用

## セットアップ手順
<1> mySQLにてユーザ、テーブル等を設定　※init.sqlにテンプレート定義済み
コマンド：
cd backend
mysql -u root < init.sql




### Webサーバ
```bash
cd frontend
cp config/db.php.sample config/db.php  # 手動で設定
