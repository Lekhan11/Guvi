FROM php:8.2-apache

# Install system packages
RUN apt-get update && apt-get install -y zip unzip git

# Enable Apache Rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Install dependencies (remove optimize for safety)
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

# Permissions fix
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
