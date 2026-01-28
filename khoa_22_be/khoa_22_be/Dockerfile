FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev libjpeg62-turbo-dev \
    libmcrypt-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install -j$(nproc) pdo_mysql pdo gd xml mbstring zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files first for better layer caching
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .

# Run composer scripts
RUN composer run-script post-autoload-dump

# Create necessary directories with proper permissions
RUN mkdir -p public/storage bootstrap/cache storage/logs && \
    chmod -R 777 public/storage bootstrap/cache storage && \
    chown -R www-data:www-data /app 2>&1 || true

# Generate app key if not exists
RUN php artisan key:generate 2>/dev/null || true

# Copy startup script
COPY start.sh /app/start.sh
RUN chmod +x /app/start.sh

EXPOSE 8000

# Run startup script that intelligently handles database setup
CMD ["/app/start.sh"]
