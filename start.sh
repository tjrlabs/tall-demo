#!/bin/sh
set -e

export PORT=${PORT:-8080}
echo "Starting on PORT=$PORT"

envsubst '${PORT}' < /etc/nginx/default.conf.template > /etc/nginx/http.d/default.conf
echo "Nginx config written:"
cat /etc/nginx/http.d/default.conf

echo "Waiting for database and running migrations..."
for i in $(seq 1 15); do
    if php artisan migrate --force; then
        break
    fi
    echo "Attempt $i failed, retrying in 3s..."
    sleep 3
done

php artisan config:cache
php artisan route:cache
php artisan view:cache

(while true; do php artisan schedule:run --no-interaction; sleep 60; done) &

php-fpm -D

nginx -t
exec nginx -g 'daemon off;'
