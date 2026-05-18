# Step 1: Use an official PHP production image with Apache
FROM php:8.2-apache

# Install minimal required system tools and clean up cache instantly to save space
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install NodeJS & NPM directly (Needed to compile Vite/Vue assets)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Grab a pre-compiled Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache ModRewrite so Laravel routes (like /home, /api) work properly
RUN a2enmod rewrite

# Set the working environment
WORKDIR /var/www/html
COPY . .

# Route Apache directly into Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Run production build commands sequentially
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Fix permissions so Apache can read/write to Laravel's cache/storage folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80