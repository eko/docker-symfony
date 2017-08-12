FROM php:5-fpm-alpine

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

# add memcached extension
ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev
RUN set -xe \
    && apk add --no-cache libmemcached-libs zlib \
    && apk add --no-cache --virtual .memcached-deps $MEMCACHED_DEPS \
    && pecl install memcached-2.2.0 \
    && docker-php-ext-enable memcached

# add redis extension
RUN curl -fsSL 'https://pecl.php.net/get/redis-3.1.3.tgz' -o redis.tar.gz \
    && mkdir -p /tmp/redis \
    && tar -xf redis.tar.gz -C /tmp/redis --strip-components=1 \
    && rm redis.tar.gz \
    && docker-php-ext-configure /tmp/redis --enable-redis-igbinary \
    && docker-php-ext-install /tmp/redis \
    && rm -r /tmp/redis

# add mongodb extension
RUN set -xe \
    && apk add --no-cache --virtual openssl-dev \
    && pecl install mongodb-1.2.9 \
    && docker-php-ext-enable mongodb

# add pdo_mysql extension
RUN docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www

ADD php.ini /usr/local/etc/php/
