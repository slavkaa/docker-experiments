FROM php:8.2-apache

# Install dependencies (including Composer)
RUN apt-get update && apt-get install -y \
    git unzip \
    && docker-php-ext-install opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the custom Apache config file to the container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy application files
COPY index.php /var/www/html/
COPY .htaccess /var/www/html/

# Install Prometheus PHP client using Composer
RUN composer require promphp/prometheus_client_php

# Expose port 80
EXPOSE 80
