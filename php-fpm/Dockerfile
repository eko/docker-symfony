FROM debian:jessie

MAINTAINER François-Xavier LACROIX <fxlacroix@gmail.com>

RUN apt-get update && apt-get install -y \
        php5-apcu \
        php5-cli \
        php5-common  \
        php5-curl \
        php5-fpm \
        php5-gd \
        php5-imagick \
        php5-intl \
        php5-mcrypt \
        php5-mysql \
        php5-xdebug

ADD symfony.ini /etc/php5/fpm/conf.d/
ADD symfony.ini /etc/php5/cli/conf.d/
ADD xdebug.ini /etc/php5/fpm/conf.d/
ADD xdebug.ini /etc/php5/cli/conf.d/

ADD symfony.pool.conf /etc/php5/fpm/pool.d/

RUN usermod -u 1000 www-data

CMD ["php5-fpm", "-F"]

EXPOSE 9000
