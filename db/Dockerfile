FROM mysql:5.7
MAINTAINER Vincent Composieux <vincent.composieux@gmail.com>

ARG CHAR_SET_SERVER
ARG COLLATION_SERVER
ARG DEFAULT_CHAR_SET

COPY zz-mysqld.cnf /etc/mysql/mysql.conf.d

RUN sed -i "s/#CHAR_SET_SERVER#/${CHAR_SET_SERVER}/g" /etc/mysql/mysql.conf.d/zz-mysqld.cnf && \
    sed -i "s/#COLLATION_SERVER#/${COLLATION_SERVER}/g" /etc/mysql/mysql.conf.d/zz-mysqld.cnf && \
    sed -i "s/#DEFAULT_CHAR_SET#/${DEFAULT_CHAR_SET}/g" /etc/mysql/mysql.conf.d/zz-mysqld.cnf
