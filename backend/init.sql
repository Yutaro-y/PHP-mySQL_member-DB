-- データベース作成
CREATE DATABASE IF NOT EXISTS member_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- DBユーザー作成（必要に応じて）
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'securepassword';
GRANT ALL PRIVILEGES ON member_db.* TO 'user'@'%';
FLUSH PRIVILEGES;

-- 使用するDB選択
USE memberdb;

-- 会員テーブル作成
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
