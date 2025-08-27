# Use official PHP with Apache
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set ServerName to avoid Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy project files into container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Point Apache to Laravel's public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Set permissions for Laravel storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port (Railway will map automatically)
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]