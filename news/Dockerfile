# Use official PHP image with Apache
FROM php:8.2-apache

# Install PHP extensions needed for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (often needed for PHP apps)
RUN a2enmod rewrite

# Copy your project files into Apache web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose Apache port
EXPOSE 80
