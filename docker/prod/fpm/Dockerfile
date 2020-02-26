ARG BASE_FPM_IMAGE

FROM akeneo/fpm:php-7.2 as dependencies

WORKDIR /srv/pim

COPY composer.json composer.lock ./

RUN php -d memory_limit=3G /usr/local/bin/composer install \
    --prefer-dist \
    --no-dev \
    --no-progress \
    --no-autoloader \
    --no-scripts

COPY app app
COPY bin bin
COPY src src
COPY var var
COPY web web

RUN composer dump-autoload \
    --no-dev \
    --classmap-authoritative \
    --no-scripts

RUN php vendor/sensio/distribution-bundle/Resources/bin/build_bootstrap.php var app new

FROM $BASE_FPM_IMAGE as fpm

# Create temporary directories
RUN mkdir -p /tmp/pim/file_storage \
 && mkdir -p /tmp/pim/upload_tmp_dir \
 && chown -R docker:docker /tmp/pim

COPY --from=dependencies --chown=docker:docker /srv/pim /srv/pim

WORKDIR /srv/pim
USER docker

RUN mkdir -p app/file_storage/catalog \
 && mkdir -p app/archive \
 && mkdir -p app/uploads/product \
 && mkdir -p web/media/cache

RUN php bin/console pim:installer:assets --env=prod --no-debug

ENV APP_ENV prod
ENV APP_DEBUG 0
