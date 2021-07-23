FROM php:8.0.6-fpm-alpine

RUN apk add --no-cache postgresql-dev fcgi \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR /app
