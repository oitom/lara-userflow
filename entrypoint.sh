#!/bin/bash

chown -R www-data:www-data /var/www/storage

# Executar composer install apenas se a pasta vendor não existir
if [ ! -d "vendor" ]; then
    composer install --no-dev --optimize-autoloader --no-interaction
fi

# Iniciar o PHP-FPM
php-fpm
