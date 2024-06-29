FROM php:8.2-fpm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# PHP dependencies
RUN docker-php-ext-install pdo_mysql

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/nginx.conf

# Copy project files
COPY . /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD ["sh", "-c", "service nginx start && php-fpm"]