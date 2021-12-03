FROM php:7.4-fpm

RUN apt-get update && apt-get install git libssl-dev libcurl3-dev libxml2-dev libzip-dev libzzip-dev libpq-dev freetds-bin zlib1g-dev -y \
  && docker-php-ext-install zip pgsql opcache soap pdo_pgsql pdo_mysql \
  && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

RUN mkdir -p /var/log/php
RUN chown www-data /var/log/php

# install composer according https://getcomposer.org/download/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"  \
    && php composer-setup.php --version="2.0.8" --install-dir=/usr/local/bin --filename=composer  \
    && php -r "unlink('composer-setup.php');"

RUN apt-get update \
    && apt-get install -y apt-transport-https
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    librabbitmq-dev

RUN yes | pecl install xdebug \
    && docker-php-ext-enable xdebug

#RUN yes | pecl install grpc \
#    && docker-php-ext-enable grpc
#RUN php -r "echo extension_loaded('grpc') ? 'yes' : 'no';"

RUN chown -R www-data:www-data /var/www
COPY --chown=www-data:www-data . /var/www
WORKDIR /var/www

RUN apt-get update --fix-missing \
    && apt-get install nginx -y
COPY docker/config/dev/fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY docker/config/dev/fpm/php.ini /usr/local/etc/php/php.ini
COPY docker/config/dev/fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/config/dev/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY docker/config/dev/nginx/php-fpm /etc/nginx/php-fpm

#add supervisor
RUN apt-get install -y supervisor
COPY docker/config/dev/supervisor/supervisord.conf /etc/supervisor

###test:local env override
ENV ENV_TEST_OVERRIDE=no

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
