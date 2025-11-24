FROM php:8.2-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install MongoDB extension
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy app
COPY . /var/www/html

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Composer install
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

EXPOSE 80
