FROM akeneo-docker-fpm

ENTRYPOINT ["php", "bin/console", "--env=prod", "--no-debug"]
CMD ["akeneo:batch:job-queue-consumer-daemon"]
