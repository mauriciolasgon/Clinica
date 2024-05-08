FROM php:8.3.6-apache

# Define o diretório de trabalho como o diretório raiz do servidor web
WORKDIR /var/www/html


# Define o usuário e o grupo apropriados para o servidor web do Apache
RUN chown -R  www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instale as dependências necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo_mysql


# Baixa e instala o Composer
COPY  --from=composer:latest /usr/bin/composer /usr/bin/composer
    
EXPOSE 80

CMD ["apache2-foreground"]