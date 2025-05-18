FROM php:8.2-apache

# تثبيت PHP Extensions
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# تفعيل mod_rewrite
RUN a2enmod rewrite

# ضبط مجلد العمل
WORKDIR /var/www/html

# نسخ المشروع بالكامل (بما في ذلك vendor)
COPY . /var/www/html

# تغيير صلاحيات التخزين
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html

# تعيين public كمجلد رئيسي في Apache
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# تشغيل السيرفر
CMD ["apache2-foreground"]

