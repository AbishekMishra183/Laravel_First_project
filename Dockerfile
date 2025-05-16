FROM dunglas/frankenphp:1-php8.2-bookworm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip \
    libicu-dev \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    && docker-php-ext-install intl zip gd pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash \
    && apt-get install nodejs -y 

# Copy caddy configuration
COPY ./Caddyfile /etc/caddy/Caddyfile

# Copy source code    
COPY . .

# Get composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install app requirements
RUN composer update \
    && composer install --prefer-dist --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && chown -R www-data:www-data bootstrap/cache storage \
    && chmod -R 775 bootstrap/cache storage 

RUN php artisan storage:link