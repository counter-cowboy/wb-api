FROM php:8.2-fpm

RUN apt-get -y update && apt-get -y upgrade
RUN docker-php-ext-install curl pdo pdo_mysql && docker-php-ext-enable curl pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

