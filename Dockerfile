FROM php:8.2-apache

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ كل ملفات المشروع إلى السيرفر
COPY . /var/www/html

# تحديد مجلد العمل
WORKDIR /var/www/html

# تثبيت الباكجات
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# صلاحيات التخزين والـ cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تغيير الـ DocumentRoot لـ public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# تفعيل mod_rewrite للـ .htaccess
RUN a2enmod rewrite

# صلاحيات عامة
RUN chmod -R 755 /var/www/html

# تشغيل Apache
CMD ["apache2-foreground"]


