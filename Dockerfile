FROM php:8.2-fpm-buster
WORKDIR /var/www/src
RUN apt update && \
    apt install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
