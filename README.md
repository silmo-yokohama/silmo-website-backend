# 環境構築手順

- 初期設定（手順0）済みならば、手順1～3を実行しテーマ開発をスタートする。
- プロジェクトは Dev/Docker/ 配下とする。


## 手順1. Dockerコンテナの起動

0. **初回コンテナ起動前に確認：[推奨設定](#推奨設定)に目を通し、必要に応じて設定する。**
1. ターミナルで作業フォルダ（wp-sample）に移動。
2. コンテナを起動。

```bash
cd silmo-website-backend
```

```bash
docker-compose up -d
```


## 手順2. WordPressの設定

1. Dockerコンテナ起動後、ブラウザで「localhost:8000」にアクセスする。
2. WordPressのセットアップを実行する。

# ディレクトリ構成

ここまでの操作では以下となる。

```markdown
silmo-website-backend
├── html/
├── phpmyadmin/
├── wp-content/
├── silmo/
└── docker-compose.yml
```

# Docker主要コマンド

|コマンド|内容|
|---|---|
|docker-compose up -d|コンテナ起動|
|docker-compose down|起動した環境の停止・削除|
|docker-compose down --volumes|停止・削除・データベース削除|
|docker-compose ps|コンテナの状態を確認する|
|docker-compose --version|Docker Composeのバージョンチェック|
|docker ps|ログインしたいコンテナ名やIDを確認する|
|docker exec -it [コンテナ名] /bin/bash|dockerで立ち上げたコンテナにログインする|

# 推奨設定

テーマ、プラグイン開発を効率よく行うための設定。

## 1. wp-contentディレクトリをマウントする

1. テーマやプラグインを直接扱えるように、作業フォルダー内にサブフォルダーを作る。
2. volumesオプションで定義する。（データが保持される）
3. マウント例：扱いやすいよう次のいずれかを設定すると良い
   - html：WordPressファイル群すべて
   - wp-content：wp-contentディレクトリのみ

```yml
  wordpress:
    volumes:
      - ./html:/var/www/html
      - ./wp-content:/var/www/html/wp-content
```

## 2. phpMyadminを使う

- データベース操作のGUIツール：phpMyAdminを使えるようにする。

```yml
phpmyadmin:
  depends_on:
    - db
  image: phpmyadmin/phpmyadmin
  environment:
    PMA_HOST: db
  restart: always
  ports:
    - "8080:80"
```
