FROM php:8.0-fpm

RUN useradd -ms /bin/bash app

RUN apt-get update && \
    apt-get install git zip unzip -y

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer

USER app