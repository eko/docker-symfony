FROM php:7-fpm-alpine

MAINTAINER runphp <runphp@qq.com>

ENV PHALCON_VERSION=3.2.1

# compile phalcon extension
RUN set -xe \
    && apk add --no-cache --virtual .build-deps autoconf g++ make pcre-dev re2c \
    && curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz \
    && tar xzf v${PHALCON_VERSION}.tar.gz \
    && cd cphalcon-${PHALCON_VERSION}/build \
    && sh install \
    && docker-php-ext-enable phalcon

# add igbinary extension
RUN set -xe \
    && pecl install igbinary-2.0.1 \
    && docker-php-ext-enable igbinary

# add mongodb extension
RUN set -xe \
    && apk add --no-cache --virtual openssl-dev \
    && pecl install mongodb-1.2.9 \
    && docker-php-ext-enable mongodb

# add pdo_mysql extension
RUN docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www

ADD php.ini /usr/local/etc/php/
