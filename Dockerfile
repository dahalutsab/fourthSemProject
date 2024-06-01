# Use an official PHP runtime as a parent image
FROM php:8.3.2-cli

# Set the working directory in the container to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install dependencies and any needed packages specified in requirements.txt
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    unzip \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pcntl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install composer dependencies
RUN composer install

# Make port 8080 available to the world outside this container
EXPOSE 8080

# Run server.php when the container launches
CMD ["php", "server.php"]
