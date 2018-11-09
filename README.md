# Dockerized Laravel

This is my attempt at putting together a docker container setup to easily get started developing for Laravel. The files in the repo are used for building custom images available on Docker Hub: `mcaubrey/c9-php7`, `mcaubrey/adminer`, `mcaubrey/nginx-for-fpm`, `mcaubrey/php-fpm`.

-----------

## Table of Contents
 * [Quick Start](#quick-start)
 * [PHP](#php)
 * [Nginx](#nginx)
 * [Adminer](#adminer)
 * [Cloud9](#cloud9)

-----------
## Quick Start
I've prepared a sample `docker-compose.yml` file using the custom images built by this repository. I recommend including a `.env` file setting `MY_TOKEN` to a personal Github access token. This will be used by  `hirak/prestissimo` to make Composer run faster. If you add a file named `laravel.env` in the same directory as `docker-compose.yml`, that file will be copied into the resulting Laravel project as its `.env` file. 

#### `docker-compose.yml`
```
version: '2.1'
services:
  nginx:
    image: mcaubrey/nginx-for-fpm
    container_name: 'nginx'
    ports:
      - '80:80'
      - '433:433'
    depends_on:
      - php
    volumes:
      - ./content/:/usr/share/nginx/html:rw
    environment:
      FPM_HOST: 'php'
      FPM_PORT: '9000'
  php:
    image: mcaubrey/php-fpm-composer
    container_name: 'php'
    depends_on:
      - postgres
    environment:
      RUN_COMPOSER: "yes"
      GITHUB_TOKEN: $MY_TOKEN
      COMPOSER_PACKAGE: 'laravel/laravel' 
    volumes:
      - ./content/:/usr/share/nginx/html:rw
      - ./laravel.env:/usr/share/nginx/laravel.env 
      - composer-cache:/root/.composer/cache 
  postgres:
    image: postgres:11
    container_name: 'postgres'
    environment:
      POSTGRES_USER: 'laravel'
      POSTGRES_PASSWORD: 'laravel'
      POSTGRES_DB: 'laravel'
      TZ: 'GMT+9'
      PGTZ: 'GMT+9'
    volumes:
      - postgres-data:/var/lib/postgresql/data:rw
  adminer:
    image: mcaubrey/adminer
    container_name: 'adminer'
    depends_on:
      - postgres
    ports:
      - 8080:8080
    environment:
      ADMINER_DEFAULT_SYSTEM: "pgsql"
      ADMINER_DEFAULT_SERVER: "postgres" 
      ADMINER_DEFAULT_USERNAME: "laravel"
      ADMINER_DEFAULT_PASSWORD: ""
      ADMINER_DEFAULT_DATABASE: "laravel"
  c9:
    container_name: c9
    image: mcaubrey/c9-php72
    volumes_from:
      - nginx
    ports:
      - 8000:8080
    environment:
      C9_WORKSPACE: '/usr/share/nginx/html'
volumes:
  composer-cache:
  postgres-data:
```

-----------
## PHP
**[`mcaubrey/php-fpm-composer` on Docker Hub](https://hub.docker.com/r/mcaubrey/php-fpm-composer/)**

This is a modifcation of the official `php72-fpm` image set up to initiate by installing a composer package if given the appropriate environment variables. Additionally, it has the correct PHP extensions installed to run Laravel out of the box.

If `RUN_COMPOSER` is set to "yes," then it will look for a composer.json file in `/usr/share/nginx/html`. If it finds one, it will run `composer install`. If it does not, it will run `composer create-project` with the target of the package specified with a `COMPOSER_PACKAGE` environment variable.

Additionally, if a `laravel.env` file is found in `/usr/share/nginx/`, it will set up the appropriate permissions for running Laravel as well as copy `laravel.env` to the project's `.env` file. 

-----------
## Nginx
**[`mcaubrey/nginx-for-fpm` on Docker Hub](https://hub.docker.com/r/mcaubrey/nginx-for-fpm/)**

This is a modifcation of the official `nginx` image. It is setup to accept two additional environment variables--`FPM_HOST` and `FPM_PORT`. This image is set up to use a FastCGI server to process PHP scripts. If the environment variables are not set the host will default to `php` and the port will default to `9000`.

-----------
## Adminer
**[`mcaubrey/adminer` on Docker Hub](https://hub.docker.com/r/mcaubrey/adminer/)**

This is a custom version of the `adminer:4.6.3` container set up to accept additional environment variables allowing you to set a default database type, server name, username, password and database.

* `ADMINER_DEFAULT_SYSTEM`

This environment variable allows you to set the type of database selected by default. The options are as follows.

| Server Type | Value |
|---|---|
| MySQL | server |
| SQLite 3 | sqlite |
| SQLite 2 | sqlite2 |
| PostgreSQL | pgsql |
| Oracle | oracle |
| MS SQL | mssql |
| Firebird | firebird |
| SimpleDB | simpledb |
| MongoDB | mongo |
| Elasticsearch | elastic |

* `ADMINER_DEFAULT_SERVER`

This should be the server that you want Adminer to connect to. When running Adminer in tandem with other docker containers, this will likely be the name of the database container.

* `ADMINER_DEFAULT_USERNAME` and `ADMINER_DEFAULT_PASSWORD`

These are pretty self explanatory. You won't want to use ADMINER_DEFAULT_PASSWORD in any context where other users might have access to the container.

* `ADMINER_DEFAULT_DATABASE`

This is the name of the database you want to select by default. 


-----------
## Cloud9
**[`mcaubrey/c9-php72` on Docker Hub](https://hub.docker.com/r/mcaubrey/c9-php72/)**

An instance of Cloud9 based on the [eeacms/cloud9](https://hub.docker.com/r/eeacms/cloud9/) docker hub image, but with php7.2 and often used development tools (curl, wget, vim) installed. This allows you to use those tools from Cloud9's terminal without having to install them yourself.

For example, if you were working on a Laravel project, you could do `php artisan tinker` from Cloud9's terminal without any additional setup.

Otherwise, the current version does not differ drastically from eeacms's version, and you can run it in the same way as described on their [repository page](https://hub.docker.com/r/eeacms/cloud9/).

-----------
Enjoy ☆彡 
