FROM php:7.3-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/

RUN apt-get update \
    && apt-get install -y libicu-dev unzip zlib1g-dev mariadb-client libzip-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-install zip pdo_mysql intl gd
    
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vender/bin

RUN composer global require "laravel/installer"

ADD . /var/www

WORKDIR /var/www

RUN chmod -R a+w storage/ bootstrap/cache

