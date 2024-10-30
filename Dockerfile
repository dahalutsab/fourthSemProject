# Use the official PHP image
FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip mysqli  # Add mysqli extension here

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy the application code
COPY . /app

# Set environment variable to allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Clear Composer cache
RUN composer clear-cache

# Create missing directory
RUN mkdir -p /app/vendor/symfony/polyfill-php83/Resources/stubs

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Set the entry point
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]