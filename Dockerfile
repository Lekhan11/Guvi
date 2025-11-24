FROM php:8.2-apache

# Install system packages
RUN apt-get update && apt-get install -y unzip git

# Enable Apache Rewrite
RUN a2enmod rewrite

# Install PHP Extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory (IMPORTANT)
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Install dependencies
RUN composer install --no-dev --optimize-autoloader || true

# Fix permissions (optional but safe)
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80
