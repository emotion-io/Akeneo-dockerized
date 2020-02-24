FROM akeneo-docker-fpm

COPY migrations migrations

ENTRYPOINT ["php", "bin/console", "--env=prod", "--no-debug"]
CMD ["about", "--quiet"]
