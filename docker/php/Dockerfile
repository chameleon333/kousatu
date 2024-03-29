FROM php:7.3-fpm

ADD . /var/www
WORKDIR /var/www

COPY ./docker/php/php.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vender/bin

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN pecl install xdebug-2.9.0 && docker-php-ext-enable xdebug

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get update \
    && apt-get install -y --no-install-recommends libicu-dev unzip zlib1g-dev mariadb-client libzip-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev libjpeg-dev nodejs git\
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) zip pdo_mysql intl gd \
    && rm -rf /var/lib/apt/lists/*

RUN npm install npm@latest -g

RUN chmod -R a+w storage/ bootstrap/cache
