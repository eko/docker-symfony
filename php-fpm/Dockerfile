FROM php:7-fpm-alpine

MAINTAINER Vincent Composieux <vincent.composieux@gmail.com>

RUN apk add --no-cache \
    freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    icu-dev \
  && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-configure gd \
    --with-gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ && \
  docker-php-ext-install -j${NPROC} \
    gd \
    intl \
    opcache \
    pdo \
    pdo_mysql \
    mysqli \
  && apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS} \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del .phpize-deps

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony && chmod a+x /usr/local/bin/symfony

ADD symfony.ini /usr/local/etc/php/conf.d/

ADD symfony.pool.conf /usr/local/etc/php-fpm.d/

CMD ["php-fpm", "-F"]

WORKDIR /var/www/symfony
EXPOSE 9001