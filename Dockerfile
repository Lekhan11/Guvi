FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis
RUN a2enmod rewrite

COPY . /var/www/html/

EXPOSE 80
