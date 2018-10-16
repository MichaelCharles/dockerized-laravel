FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libmcrypt-dev \
    apache2-bin \
    curl \
    vim \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    elinks \
    unzip \
    zip \
    libssl-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/var/lib/postgresql
RUN docker-php-ext-install    pdo_pgsql 
RUN docker-php-ext-install    pdo_mysql
RUN docker-php-ext-install    pgsql 
RUN docker-php-ext-install    gd 
RUN docker-php-ext-install    intl
