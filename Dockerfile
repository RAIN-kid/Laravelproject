FROM node:18-bullseye

# Install PHP and Composer
RUN apt-get update && apt-get install -y php php-cli php-mbstring unzip curl git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm ci
RUN npm run build

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080