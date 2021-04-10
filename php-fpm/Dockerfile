FROM alpine:3.13

LABEL maintainer="Vincent Composieux <vincent.composieux@gmail.com>"

RUN apk add --no-cache \
    coreutils \
    php8-fpm \
    php8-ctype \
    php8-curl \
    php8-dom \
    php8-gd \
    php8-iconv \
    php8-json \
    php8-intl \
    php8-fileinfo\
    php8-mbstring \
    php8-opcache \
    php8-openssl \
    php8-pdo \
    php8-pdo_mysql \
    php8-mysqli \
    php8-xml \
    php8-zlib \
    php8-phar \
    php8-tokenizer \
    php8-session \
    php8-simplexml \
    php8-zip \
    php8-xmlwriter \
    php8-pecl-apcu \
    make \
    curl

# Allow to enable php8-xdebug
ARG ENABLE_PHP_XDEBUG
RUN if [[ "$ENABLE_PHP_XDEBUG" == "1" ]]; then \
        apk add --no-cache php8-pecl-xdebug; \
    fi

RUN curl -sS https://getcomposer.org/installer | tee composer-setup.php \
    && php8 composer-setup.php && rm composer-setup.php* \
    && chmod +x composer.phar && mv composer.phar /usr/bin/composer \
    && ln -s /usr/bin/php8 /usr/local/bin/php

COPY symfony.ini /etc/php8/conf.d/
COPY symfony.ini /etc/php8/cli/conf.d/
COPY xdebug.ini  /etc/php8/conf.d/

COPY symfony.pool.conf /etc/php8/php-fpm.d/

WORKDIR /var/www/symfony

CMD ["php-fpm8", "-F"]

EXPOSE 9001
