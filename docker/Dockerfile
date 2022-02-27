FROM composer:2.0.14 as composer

FROM php:8.1-cli-alpine3.15 as php

ENV COMPOSER_HOME=/root/composer \
    PATH=$COMPOSER_HOME/vendor/bin:$PATH \
    COMPOSER_ALLOW_SUPERUSER=1 \
    DEBCONF_NOWARNINGS=yes

COPY --from=composer /usr/bin/composer /usr/bin/composer

# package install and setup
RUN set -eux \
 && apk add --update-cache --no-cache openssl git autoconf g++ libtool make libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev \
 && docker-php-ext-configure gd --with-jpeg=/usr \
 && docker-php-ext-configure opcache --enable-opcache \
 && docker-php-ext-install opcache bcmath gd exif zip \
 && apk del autoconf g++ libtool make && rm -rf /tmp/*

# file
COPY ./php.ini /usr/local/etc/php/php.ini
