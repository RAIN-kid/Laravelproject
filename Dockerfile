FROM php:8.2-cli

# 1. Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip curl gnupg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd dom xml

# 2. Install Node.js (LTS) & npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Set workdir
WORKDIR /app

# 5. Copy project files
COPY . .

# 6. Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-req=ext-dom --ignore-platform-req=ext-xml

# 7. Install Node dependencies and build frontend assets (for Vite/Mix)
RUN if [ -f package.json ]; then npm install && npm run build; fi

# 8. Expose port for Laravel serve
EXPOSE 8080

# 9. Start Laravel app
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080