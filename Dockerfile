FROM php:8.2-apache

# Install basic libs
RUN apt-get update && apt-get install -y \
    zip unzip git curl

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies inside container
RUN composer install --
