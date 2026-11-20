FROM php:8.2-apache

# Instalar extensiones necesarias de PHP (mysqli, gd)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Configurar permisos para carpeta de subida de archivos (data)
RUN mkdir -p /var/www/html/data && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
