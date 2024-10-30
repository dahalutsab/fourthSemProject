# Use the official PHP image
FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy only composer files initially to leverage Docker cache
COPY composer.json composer.lock /app/

# Install PHP dependencies (without the application code yet)
RUN composer install --no-dev --optimize-autoloader

# Clear Composer cache after installing dependencies
RUN composer clear-cache

# Copy the rest of the application code
COPY . /app

# Ensure necessary directories are created and permissions are set
RUN mkdir -p /app/vendor/symfony/polyfill-php83/Resources/stubs \
    && chown -R www-data:www-data /app \
    && chmod -R 755 /app

# Expose port 80
EXPOSE 80

# Set the entry point
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
