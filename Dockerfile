FROM php:8.2-apache

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

# 👇 AGREGA ESTO (CLAVE)
ENV APACHE_DOCUMENT_ROOT /var/www/html

# 👇 Ajusta Apache correctamente
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html/

EXPOSE 80