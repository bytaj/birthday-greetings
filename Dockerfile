FROM php:8.2-fpm-alpine as dev

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /app

USER root
