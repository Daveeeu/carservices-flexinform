# Laravel és Node.js környezet
FROM php:8.3-fpm AS base

# Rendszerfüggőségek telepítése
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    npm \
    libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd zip bcmath && \
    pecl install redis && docker-php-ext-enable redis

# Composer telepítése
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Munkakönyvtár beállítása
WORKDIR /var/www/html

# Laravel fájlok másolása
COPY ../.. .

# .env fájl létrehozása .env.example alapján
RUN cp .env.example .env

# Jogosultságok beállítása
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# PHP csomagok telepítése
RUN composer install --no-dev --optimize-autoloader

# Node.js függőségek telepítése és buildelés
RUN npm install && npm run build

# Laravel kulcs generálása
RUN php artisan key:generate
#RUN php artisan migrate

CMD ["php-fpm"]
