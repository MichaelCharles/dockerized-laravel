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
    libssl-dev \
    libzip-dev \
    git \
    dos2unix

RUN docker-php-ext-configure pgsql -with-pgsql=/var/lib/postgresql
RUN docker-php-ext-install    pdo_pgsql 
RUN docker-php-ext-install    pdo_mysql
RUN docker-php-ext-install    pgsql 
RUN docker-php-ext-install    gd 
RUN docker-php-ext-install    intl
RUN docker-php-ext-install    zip

RUN apt-get install -y git libzip-dev

RUN (cd ~ && curl -sS https://getcomposer.org/installer -o composer-setup.php && php composer-setup.php --install-dir=/usr/local/bin --filename=composer)

RUN mkdir /usr/share/nginx/

COPY custom-docker-php-entrypoint /usr/local/bin/

RUN dos2unix /usr/local/bin/custom-docker-php-entrypoint

RUN composer global require hirak/prestissimo
WORKDIR /usr/share/nginx/
ENTRYPOINT ["custom-docker-php-entrypoint"]
CMD ["php-fpm"]
