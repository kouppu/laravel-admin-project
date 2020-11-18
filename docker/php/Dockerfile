FROM php:7.3-fpm

WORKDIR /var/www

COPY ./src /var/www

COPY ./docker/php/php.ini /usr/local/etc/php/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update \
  && apt-get install -y procps zip libzip-dev wget git unzip libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev  \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip pdo_mysql \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

# RUN php artisan config:cache \
  # && php artisan view:cache \
  # && php artisan event:cache

RUN chown -R www-data:www-data /var/www \
  && chmod -R 755 /var/www
