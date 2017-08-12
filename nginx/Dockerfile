FROM nginx:alpine

MAINTAINER runphp <runphp@qq.com>

ADD sites-available/_.conf /etc/nginx/conf.d/
ADD sites-available/api_eelly_dev.conf /etc/nginx/conf.d/
ADD sites-available/www_eelly_dev.conf /etc/nginx/conf.d/

RUN echo "upstream php5-upstream { server php5:9000; }" > /etc/nginx/conf.d/php5upstream.conf
RUN echo "upstream php7-upstream { server php7:9000; }" > /etc/nginx/conf.d/php7upstream.conf
