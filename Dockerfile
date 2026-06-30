# Menggunakan base image PHP resmi dengan Apache
FROM php:8.2-apache

# Install ekstensi dan dependency system (Cron, SQLite, Unzip)
RUN apt-get update && apt-get install -y \
    cron \
    sqlite3 \
    libsqlite3-dev \
    unzip \
    && docker-php-ext-install pdo pdo_sqlite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Mengaktifkan modul rewrite
RUN a2enmod rewrite

# Copy composer dari official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin semua file dari direktori saat ini ke direktori root web server di dalam container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install dependensi PHP (Web Push) via Composer
RUN composer install --no-dev --optimize-autoloader

# Setup Cronjob untuk mengecek gempa setiap 1 menit
RUN echo "* * * * * root /usr/local/bin/php /var/www/html/cron/check_gempa.php >> /var/log/cron.log 2>&1" > /etc/cron.d/gempa-cron \
    && chmod 0644 /etc/cron.d/gempa-cron \
    && crontab /etc/cron.d/gempa-cron \
    && touch /var/log/cron.log

# Ubah kepemilikan file ke user 'www-data' (user default Apache) agar tidak ada masalah permission (database write access)
RUN mkdir -p /var/www/data \
    && chown -R www-data:www-data /var/www/html /var/www/data \
    && chmod -R 775 /var/www/html /var/www/data

EXPOSE 80

# Start cron di background dan jalankan apache di foreground
CMD cron && apache2-foreground
