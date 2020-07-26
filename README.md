# SAISAN Ver.2
採算管理システムのバージョン2を作成！

# コンテナの起動
docker-compose up -d --build
http://127.0.0.1:20080/

# コンテナの停止
docker-compose down

# 初回コンテナ起動時に実行してな！
初回コンテナの起動時はブラウザ表示の際に、まず下記のエラーが出る
"Warning: require(/work/public/../vendor/autoload.php): failed to open stream: No such file or directory in /work/public/index.php on line 24"

初回起動時はwork/vendorディレクトリーが存在しないのでインストール
docker-compose exec app ash
composer install

そして、この後画面をリロードすると500エラーが出力される
composerインストール時は.envファイルが生成されないので、引き続きappコンテナのなかで、
cp .env.example .env

画面をリロードすると今度は下記のエラーがでる
RuntimeException : No application encryption key has been specified.

.envにAPP_KEY=の値がないとこのエラーが出力されるので、
php artisan key:generate

最後にマイグレーションしていったん終了!
php artisan migrate

# 開発していて不思議に感じたこと

1 : 新しくVueコンポーネントを実装してもブラウザで反映されなかった
　・DockerのNginxコンテナ上だとLaravelの内蔵サーバー起動時と異なり変更がリアルタイムで反映されなかった
　・Chromeでキャッシュの削除とハードの再読み込みを行うと変更が反映された
