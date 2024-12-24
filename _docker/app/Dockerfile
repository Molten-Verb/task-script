FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      git && \
      docker-php-ext-install pdo_pgsql && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www

RUN a2enmod rewrite
RUN service apache2 restart

EXPOSE 80
