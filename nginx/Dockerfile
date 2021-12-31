FROM nginx:1.21.5

LABEL maintainer="Vincent Composieux <vincent.composieux@gmail.com>"

RUN mkdir -p /etc/nginx/templates \
    mkdir -p /tmp/nginx

COPY nginx.conf /etc/nginx/
COPY templates/* /etc/nginx/templates/
COPY html/index.html.template /tmp/nginx/

ARG NGINX_SYMFONY_SERVER_NAME
ARG KIBANA_PORT
RUN envsubst < /tmp/nginx/index.html.template > /usr/share/nginx/html/index.html; \
    rm -fR /tmp/nginx

CMD ["nginx"]

EXPOSE 80
EXPOSE 443
