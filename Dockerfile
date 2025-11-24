FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y unzip git

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Run composer install inside container
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
