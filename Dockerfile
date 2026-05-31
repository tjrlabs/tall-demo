FROM node:22-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx gettext postgresql-dev libpq

RUN docker-php-ext-install pdo_pgsql opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

COPY . .
COPY --from=assets /app/public/build public/build

RUN echo "APP_KEY=base64:$(php -r 'echo base64_encode(random_bytes(32));')" > .env \
    && php artisan package:discover --ansi \
    && rm .env

RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

RUN rm -f /etc/nginx/http.d/default.conf
COPY docker/nginx/default.conf.template /etc/nginx/default.conf.template
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/99-opcache.ini
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080
CMD ["/start.sh"]
