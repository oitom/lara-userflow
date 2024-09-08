# Usar a imagem base do PHP com FPM
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

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto para o container
COPY . .

# Configurar permissões para a pasta storage
RUN mkdir -p /var/www/storage && \
    chown -R www-data:www-data /var/www/storage && \
    chmod -R 775 /var/www/storage

# Expor a porta
EXPOSE 9000
