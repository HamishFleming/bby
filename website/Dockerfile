FROM php:8.2.0-fpm-alpine
RUN apk add libzip-dev zip && docker-php-ext-install zip

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
# RUN docker-php-ext-install nd_mysqli pdo pdo_mysql && docker-php-ext-enable nd_mysqli
