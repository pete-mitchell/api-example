FROM php:7.4-fpm as php

# Install extra PHP modules
RUN set -x \
    && apt-get update && apt-get install -y \
      libpq-dev git \
    && docker-php-ext-configure pdo_pgsql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-configure opcache \
    && docker-php-ext-install opcache \
    # Cleanup
    && apt-get purge -y --auto-remove \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www
CMD php-fpm
EXPOSE 9000
