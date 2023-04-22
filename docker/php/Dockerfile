FROM php:8.1-fpm

#ENV HTTP_PROXY="http://192.168.1.191:10809"
WORKDIR /var/www/html
#COPY sources.list /etc/apt/sources.list
RUN apt-get update --fix-missing -y \
        && apt-get upgrade -y \
        && apt-get install -y nano\
                              htop \
                              procps \
                              libpng-dev \
                              zlib1g-dev \
                              libonig-dev \
                              build-essential \
                              git \
                              curl \
                              libfreetype6-dev \
                              libjpeg62-turbo-dev \
                              libssl-dev \
                              libjpeg-dev \
                              libonig-dev \
                              libicu-dev

RUN apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install curl
########## SSL ##########
RUN apt-get install -y --no-install-recommends openssl

######### Mysql client ######
RUN apt-get install -y default-mysql-client

########## PHP zip ##########
RUN apt-get install -y --no-install-recommends libzip-dev unzip \
        && docker-php-ext-install zip

########## PHP exif ##########
RUN docker-php-ext-install exif

########## PHP gd ##########
RUN docker-php-ext-configure gd  --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd

########## PHP bcmath ##########
RUN docker-php-ext-install bcmath


########## PHP pdo ##########
RUN docker-php-ext-install pdo pdo_mysql

########## PHP soap #########
RUN apt-get install -y \
     libxml2-dev \
     && docker-php-ext-install soap

########## Composer ##########
RUN mkdir /var/www/.composer \
        && chown www-data:www-data /var/www/.composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

######## ini ######
COPY php.ini-production ${PHP_INI_DIR}/php.ini
COPY opcache.ini ${PHP_INI_DIR}/conf.d/opcache.ini

########## PHP pcntl #########
RUN docker-php-ext-install pcntl

RUN apt-get install -y git
