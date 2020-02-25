ARG BASE_SECRET_WEBSERVER_IMAGE

FROM akeneo-docker-fpm as bundle-assets

RUN php bin/console pim:installer:assets --env=prod --no-debug

FROM node:10-slim as compiled-assets

WORKDIR /srv/pim

COPY package.json yarn.lock ./
RUN yarn install

COPY --from=bundle-assets /srv/pim /srv/pim

RUN yarn run less && yarn run webpack

FROM $BASE_SECRET_WEBSERVER_IMAGE as web-server

COPY --from=compiled-assets --chown=root:root /srv/pim/web /srv/pim/web
