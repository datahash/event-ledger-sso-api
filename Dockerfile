FROM php:8.0-apache

ENV APP_HOME /var/www/html
ENV APP_DOCUMENT_ROOT /var/www/html/public
ENV USERNAME=www-data
ARG BUILD_ENV

RUN apt-get update

RUN apt-get install -y \
    procps \
    git \
    zip \
    curl \
    sudo \
    unzip \
    nano \
    supervisor \
    cron \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libxml2 \
    libxml2-dev \
    libzip-dev \
    g++

RUN docker-php-ext-install \
    pdo_mysql \
    sockets \
    intl \
    opcache \
    zip

RUN apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN a2dissite 000-default.conf
RUN sed -ri -e 's!/var/www/html!${APP_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APP_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY ./build/apache/laravel.conf /etc/apache2/sites-available/laravel.conf
RUN a2ensite laravel.conf
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite

WORKDIR $APP_HOME

USER ${USERNAME}

RUN chown -R ${USERNAME}:${USERNAME} $APP_HOME
COPY --chown=${USERNAME}:${USERNAME} . $APP_HOME/
COPY ./build/general/.env.sample $APP_HOME/.env

RUN composer install
RUN composer update

USER root
