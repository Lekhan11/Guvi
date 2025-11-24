FROM php:8.2-apache

# Enable apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . /var/www/html

# Give permissions
RUN chown -R www-data:www-data /var/www/html

# Install mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql
