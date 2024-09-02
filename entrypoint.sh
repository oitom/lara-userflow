#!/bin/bash

# Executar composer install apenas se a pasta vendor não existir
if [ ! -d "vendor" ]; then
    composer install --no-dev --optimize-autoloader --no-interaction
fi

# Iniciar o PHP-FPM
php-fpm
