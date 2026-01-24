FROM php:8.2-fpm

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev libjpeg62-turbo-dev \
    libmcrypt-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install -j$(nproc) pdo_mysql gd xml mbstring \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Remove symlink if exists
RUN rm -rf public/storage 2>/dev/null; mkdir -p public/storage bootstrap/cache; chmod -R 777 public/storage bootstrap/cache storage

RUN composer install --no-interaction --no-dev --optimize-autoloader 2>&1 || true

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache 2>&1 || true

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
