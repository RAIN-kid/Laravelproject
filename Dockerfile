# Tumia base image ya PHP yenye composer na Node.js tayari
FROM composer:2.7 as build

# Install Node.js (Railway inahitaji version ya Node kwa Vite)
RUN apt-get update && apt-get install -y nodejs npm git unzip \
    # PHP extensions muhimu kwa Laravel
    && apt-get install -y libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd dom xml tokenizer

WORKDIR /app

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy rest of the app files
COPY . .

# Install Node dependencies and build assets
RUN npm install && npm run build

# Stage ya mwisho: production image (nyepesi, secure)
FROM php:8.1-cli

# Install extensions kwenye production image pia
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd dom xml tokenizer

WORKDIR /app

COPY --from=build /app /app

# Copy composer na npm kutoka image ya build
COPY --from=build /usr/bin/composer /usr/bin/composer

# Expose port ya Laravel serve
EXPOSE 8080

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080