FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli 

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html