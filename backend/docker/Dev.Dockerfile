FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        intl \
        exif \
        pcntl \
        bcmath \
        xml \
        gd \
        zip \
        curl \
        opcache \
    && pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/backend

# Copy Laravel app
COPY . /var/www/backend

# Set proper permissions
RUN chown -R www-data:www-data /var/www/backend \
    && chmod -R 775 /var/www/backend/storage /var/www/backend/bootstrap/cache

# Expose FPM port
EXPOSE 9000

CMD ["php-fpm"]
