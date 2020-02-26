ARG BASE_SECRET_WEBSERVER_IMAGE

FROM node:10-slim as compiled-assets

WORKDIR /srv/pim

COPY package.json yarn.lock ./
RUN yarn install

COPY --from=akeneo-docker-fpm /srv/pim /srv/pim

RUN yarn run less && yarn run webpack

FROM $BASE_SECRET_WEBSERVER_IMAGE as web-server

#COPY --from=compiled-assets --chown=root:root /srv/pim/web /srv/pim/web
COPY --from=compiled-assets --chown=1000:1000 /srv/pim/web /srv/pim/web
