FROM php:8.1-cli

# Install required packages
RUN apt-get update && \
    apt-get install -y git libzip-dev unzip librabbitmq-dev && \
    docker-php-ext-install zip bcmath sockets && \
    pecl install amqp && \
    docker-php-ext-enable amqp

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install dependencies
RUN composer install --no-interaction

# Expose ports
EXPOSE 80

# Start server
CMD ["php", "bin/console", "server:run", "0.0.0.0:80"]
