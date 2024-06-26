FROM php:8.3.6-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    iputils-ping \
    dnsutils \
    netcat-openbsd

# Limpar o cache do apt-get
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Obter o Composer mais recente
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Copiar o código do Laravel para o diretório de trabalho do Apache
COPY /laravel /var/www/html

# Copiar o script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Garantir que o script de entrada tenha permissões de execução
RUN chmod +x /usr/local/bin/entrypoint.sh

# Instalar dependências do Node.js
RUN cd /var/www/html && npm install

# Instalar dependências do Composer
RUN cd /var/www/html && composer install

# Executar build do npm
RUN cd /var/www/html && npm run build

# Habilitar o mod_rewrite do Apache
RUN a2enmod rewrite

# Definir permissões apropriadas para o diretório de armazenamento
RUN chown -R www-data:www-data /var/www/html/storage/

# Definir a diretiva ServerName globalmente para suprimir avisos de sintaxe
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expor a porta 80
EXPOSE 80 3000

# Definir o script de entrada a ser executado quando o contêiner iniciar
CMD ["/usr/local/bin/entrypoint.sh"]