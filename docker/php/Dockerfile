# FROM命令は、以降の命令で使用するベースイメージの設定　必須
FROM php:7.3-fpm-alpine

# LABEL命令はイメージにメタデータを追加。キーとバリューのペア。
LABEL maintainer "Taichi-Kashima"

# 構築時に作業者がdocker buildで使う変数、フラグを定義
ARG TZ

# ENVは環境変数キーとバリューのセット
# 1を設定するとrootでのインストールを許可できる
ENV COMPOSER_ALLOW_SUPERUSER 1
# コンポーザーのホームディレクトリを変更
ENV COMPOSER_HOME /composer

# 既存イメージ上の新しいレイヤで、あらゆるコマンドを実行し、その結果をコミットする
RUN set -eux && \
    apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
    cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
    apk del .build-dependencies && \
    docker-php-ext-install bcmath pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
    composer config -g repos.packagist composer https://packagist.jp && \
    composer global require hirak/prestissimo

# set -eux && \ ビルド状況の出力
# apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
#   add : パッケージの追加、インストール
#   --update-cache : リモートリポジトリの更新を入手
#   --no-cache : キャッシュの削除
#   --virtual=.build-dependencies tzdata : まとめてインストールしたパッケージ群にエイリアスをつける
# cp /usr/share/zoneinfo/${TZ} /etc/localtime
#   alpineの/usr/share/zoneinfo/${TZ}を/etc/localtimeにコピーする
# apk del .build-dependencies && \
#   エイリアス指定したパッケージをアンインストール
# docker-php-ext-install bcmath pdo_mysql && \
#   docker-php-ext-install : コンテナイメージに事前に圧縮されて入っているエクステンションを解凍してインストール。
#    bcmath : 10桁以上の数字の計算を行うのに便利なモジュール
#    pdo_mysql : PDO API で MySQL に接続するためのドライバ
# curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
#   curl : サーバーから、もしくはサーバーへデータ転送を行うコマンド
#    -s : 実行中・エラーのメッセージを表示しない
#    -S : 
#    -sS https://getcomposer.org/installer : コンポーザーのインストール
#    | : 標準出力を他のコマンドの標準入力につなげることができる。これをパイプという
# php -- --install-dir=/usr/bin --filename=composer && \
#   --install-dir=/usr/bin : インストールとフォルダの指定
#   --filename=composer && \ : ファイル名の指定
# !! 以下の2つのコマンドに関しては、https://qiita.com/keitakn/items/37f0fac49442b72c403eを参考にする !!
# composer config -g repos.packagist composer https://packagist.jp && \ : packagistのミラーサーバを日本国内のサーバに変更する
# composer global require hirak/prestissimo : Composerプラグインによる高速化
#
#