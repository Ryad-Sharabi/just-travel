FROM php:8.2-apache

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ المشروع
COPY . /var/www/html/

# إعداد صلاحيات Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# تفعيل mod_rewrite لـ Laravel routes
RUN a2enmod rewrite

# إعادة تشغيل Apache
CMD ["apache2-foreground"]


