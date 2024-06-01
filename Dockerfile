# Use an official PHP runtime as a parent image
FROM php:7.4-cli

# Set the working directory in the container to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install any needed packages specified in requirements.txt
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pcntl

# Make port 8080 available to the world outside this container
EXPOSE 8080

# Run server.php when the container launches
CMD ["php", "server.php"]