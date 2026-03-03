FROM php:8.5-apache

RUN docker-php-ext-install pdo pdo_mysql 

COPY ./src/ /var/www/html/

EXPOSE 80

CMD [ "apache2-foreground" ]