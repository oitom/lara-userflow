FROM php:8.1-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

RUN mkdir -p /var/www/html/storage/logs && \
    chown -R www-data:www-data /var/www/html/storage && \
    chmod -R 775 /var/www/html/storage

# Copiar arquivos para o contêiner
COPY . .

# Copiar o script de entrypoint
COPY entrypoint.sh /entrypoint.sh

# Garantir permissões corretas para o entrypoint
RUN chmod +x /entrypoint.sh

# Expor a porta
EXPOSE 9000

# Configurar entrypoint
ENTRYPOINT ["/entrypoint.sh"]
