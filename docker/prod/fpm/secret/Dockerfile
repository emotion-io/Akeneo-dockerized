FROM php:7.2-fpm-alpine

LABEL maintainer="Justas Bieliauskas github.com/justasbieliauskas"

# Various
RUN docker-php-ext-install pdo_mysql bcmath exif

# APCu
RUN apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
 && pecl install apcu \
 && docker-php-ext-enable apcu \
 && pecl clear-cache \
 && apk del .build-dependencies

# GD
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev \
 && docker-php-ext-configure gd \
      --with-gd \
      --with-freetype-dir=/usr/include/ \
      --with-png-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
 && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
 && docker-php-ext-install -j${NPROC} gd \
 && apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# Intl
RUN apk add --update --no-cache icu icu-dev \
 && docker-php-ext-configure intl \
 && docker-php-ext-install intl

# Zip
RUN apk add --update --no-cache zlib-dev \
 && docker-php-ext-install zip

# imagick
RUN apk add --update --no-cache autoconf g++ imagemagick-dev libtool make pcre-dev \
 && pecl install imagick \
 && docker-php-ext-enable imagick \
 && apk del autoconf g++ libtool make pcre-dev

COPY php.ini /usr/local/etc/php

# Create docker user
RUN addgroup docker && adduser -D -G docker docker
