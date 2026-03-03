FROM php:8.5-apache

RUN apt-get update && apt-get install -y unzip git

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader

COPY bootstrap.php migrations.php index.php ./
COPY src/ ./src/
COPY lib/ ./lib/
COPY bin/ ./bin/
COPY entrypoint.sh ./

EXPOSE 80

ENTRYPOINT ["bash", "entrypoint.sh"]
