FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/nginx.conf

# Set the working directory
WORKDIR /var/www/html

# Copy project files before installing dependencies
COPY . .

# Install PHP dependencies
RUN composer install

EXPOSE 80

CMD ["sh", "-c", "service nginx start && php-fpm"]
