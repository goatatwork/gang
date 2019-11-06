FROM php:7.2-fpm

LABEL maintainer="goat <ryantgray@gmail.com>"

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        curl \
        zip \
        unzip \
        git \
        zlib1g-dev \
        libicu-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install -j$(nproc) pcntl \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y supervisor \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN mkdir /var/www/.composer && chown www-data.www-data /var/www/.composer
RUN mkdir /var/www/.config && chown www-data.www-data /var/www/.config
RUN mkdir /var/www/.npm && chown www-data.www-data /var/www/.npm
RUN mkdir /var/www/.ssh && chown www-data.www-data /var/www/.ssh

USER www-data

WORKDIR /var/www/html

COPY supervisord.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
