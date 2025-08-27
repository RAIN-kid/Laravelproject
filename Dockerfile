FROM php:8.2-cli

# 1. Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl gnupg libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd dom zip

# 2. Install Node.js (LTS 18)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Set workdir
WORKDIR /app

# 5. Copy project files
COPY . .

# 6. Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 7. Install Node dependencies & build frontend assets
RUN npm install && npm run build

# 8. Expose port
EXPOSE 8080

# 9. Start Laravel app (serve from public directory)
CMD php -S 0.0.0.0:8080 -t public
