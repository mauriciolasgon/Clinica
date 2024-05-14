FROM php:8.3.6-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

COPY /laravel /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN composer install
 
EXPOSE 80

CMD ["apache2-foreground"]