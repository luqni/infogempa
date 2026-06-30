# Menggunakan base image PHP resmi dengan Apache
FROM php:8.2-apache

# Mengaktifkan modul rewrite (opsional, sangat berguna jika ke depannya ada perubahan routing)
RUN a2enmod rewrite

# Salin semua file dari direktori saat ini ke direktori root web server di dalam container
COPY . /var/www/html/

# Ubah kepemilikan file ke user 'www-data' (user default Apache) agar tidak ada masalah permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 (standar web)
EXPOSE 80
