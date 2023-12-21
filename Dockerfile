FROM php:8.1-apache as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Instalar dependencias necesarias para GD
RUN apt-get update && \
    apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

# Habilitar la extensión GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd
WORKDIR /var/www

COPY . .


COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

RUN npm install

ENV PORT=8000
ENTRYPOINT ["docker/entrypoint.sh"]
RUN chmod +rx docker/entrypoint.sh
# =========================================
# node
# FROM node:18-alpine as node

# WORKDIR /var/www
# COPY . .

# RUN npm install
# EXPOSE 3000

# VOLUME /var/www/node_modules
