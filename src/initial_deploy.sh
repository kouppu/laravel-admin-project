# 初回デプロイ用シェル
. ./.env

set -xe

if [ -z "$APP_KEY" ]; then
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan storage:link
    echo "Finish"
else
  echo "Already initially deployed"
fi
