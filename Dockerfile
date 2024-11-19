# Menggunakan base image PHP 8.2 dengan FPM untuk Laravel
FROM php:8.1-fpm

# Install dependencies dan PHP extension yang dibutuhkan untuk Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Menyalin izin untuk direktori Laravel agar storage dan cache dapat ditulis
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Menyimpan environment file (.env)
COPY .env.example .env

# Install dependencies Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generate Laravel APP_KEY
RUN php artisan key:generate

# Expose port 80 untuk mengakses aplikasi melalui Nginx
EXPOSE 80

# Perintah untuk memulai PHP-FPM saat container berjalan
CMD ["php-fpm"]
