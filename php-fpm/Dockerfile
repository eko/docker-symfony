FROM alpine:3.17

LABEL maintainer="Vincent Composieux <vincent.composieux@gmail.com>"

RUN apk add --no-cache \
    coreutils \
    gettext \
    php81-fpm \
    php81-ctype \
    php81-curl \
    php81-dom \
    php81-gd \
    php81-iconv \
    php81-json \
    php81-intl \
    php81-fileinfo\
    php81-mbstring \
    php81-opcache \
    php81-openssl \
    php81-pdo \
    php81-pdo_mysql \
    php81-mysqli \
    php81-xml \
    php81-xsl \
    php81-zlib \
    php81-phar \
    php81-tokenizer \
    php81-session \
    php81-simplexml \
    php81-zip \
    php81-xmlwriter \
    php81-sodium \
    php81-pecl-apcu \
    make \
    curl

# Enable php8-xdebug if $PHP_XDEBUG_MODE is not empty
ARG PHP_XDEBUG_MODE=off
ARG PHP_XDEBUG_CLIENT_PORT=5902
ARG PHP_XDEBUG_CLIENT_HOST=host.docker.internal
COPY xdebug.ini  /etc/php81/conf.d/xdebug.ini.template
RUN if [[ "$PHP_XDEBUG_MODE" != "" ]]; then \
        apk add --no-cache php81-pecl-xdebug; \
        export PHP_XDEBUG_MODE=$PHP_XDEBUG_MODE; \
        export PHP_XDEBUG_CLIENT_PORT=$PHP_XDEBUG_CLIENT_PORT; \
        export PHP_XDEBUG_CLIENT_HOST=$PHP_XDEBUG_CLIENT_HOST; \
        envsubst < /etc/php81/conf.d/xdebug.ini.template > /etc/php81/conf.d/xdebug.ini; \
    fi
RUN rm -f /etc/php81/conf.d/xdebug.ini.template

RUN curl -sS https://getcomposer.org/installer | tee composer-setup.php \
    && php81 composer-setup.php && rm composer-setup.php* \
    && chmod +x composer.phar && mv composer.phar /usr/bin/composer \
    && ln -s /usr/bin/php81 /usr/local/bin/php

ARG SYMFONY_CLI_VERSION
RUN wget https://github.com/symfony/cli/releases/download/v$SYMFONY_CLI_VERSION/symfony_linux_amd64.gz \
    && gzip -d symfony_linux_amd64.gz \
    && mv symfony_linux_amd64 symfony \
    && chmod +x symfony \
    && mv symfony /usr/local/bin/

RUN apk add --update nodejs npm \
    && npm install --global yarn

COPY symfony.ini /etc/php81/conf.d/
COPY symfony.ini /etc/php81/cli/conf.d/

COPY symfony.pool.conf /etc/php81/php-fpm.d/

WORKDIR /var/www/symfony

CMD ["php-fpm81", "-F"]

EXPOSE 9001
