docker-symfony
==============

[![Build Status](https://secure.travis-ci.org/eko/docker-symfony.png?branch=master)](http://travis-ci.org/eko/docker-symfony)


Just a little Docker POC in order to have a complete stack for running Symfony into Docker containers using docker-compose tool.

# Installation

First, clone this repository:

```bash
$ git clone git@github.com:eko/docker-symfony.git
```

Add `symfony.dev` in your `/etc/hosts` file.

Either put your Symfony application into `symfony` folder or add `.env` to your symfony project with following content
```yaml
COMPOSE_FILE=../docker-symfony/docker-compose.yml
COMPOSE_PROJECT_NAME=PROJECT_NAME
LOG_PATH=../PROJECT_NAME/logs
SRC_PATH=../PROJECT_NAME/src
XDEBUG_IP_ADDRESS=
```

Make sure you adjust `database_host` in `parameters.yml` to the database container alias "db"

Then, run:

```bash
$ docker-compose up
```

You are done, you can visit your Symfony application on the following URL: `http://symfony.dev` (and access Kibana on `http://symfony.dev:81`)

_Note :_ you can rebuild all Docker images by running:

```bash
$ docker-compose build
```

# How it works?

Here are the `docker-compose` built images:

* `db`: This is the MySQL database container (can be changed to postgresql or whatever in `docker-compose.yml` file),
* `php`: This is the PHP-FPM container including the application volume mounted on,
* `nginx`: This is the Nginx webserver container in which php volumes are mounted too,
* `elk`: This is a ELK stack container which uses Logstash to collect logs, send them into Elasticsearch and visualize them with Kibana.

This results in the following running containers:

```bash
> $ docker-compose ps
        Name                      Command               State              Ports
        -------------------------------------------------------------------------------------------
        docker_db_1            /entrypoint.sh mysqld            Up      0.0.0.0:3306->3306/tcp
        docker_elk_1           /usr/bin/supervisord -n -c ...   Up      0.0.0.0:81->80/tcp
        docker_nginx_1         nginx                            Up      443/tcp, 0.0.0.0:80->80/tcp
        docker_php_1           php5-fpm -F                      Up      9001/tcp
```

# Development

Attach to php container to call compose or symfony.

```bash
$ docker-compose exec php /bin/sh
```

## XDebug

* Set local ip in .env, e.g.  `XDEBUG_IP_ADDRESS=10.0.75.1` in .env (on windows/mac use VM IP)
* In your IDE set XDebug listen port to 9030. Depending on IDE set IP.
* Use XDebug Helper or similar to start debugging session

# Read logs

You can access Nginx and Symfony application logs in the following directories on your host machine:

* `logs/nginx`
* `logs/symfony`

# Use Kibana!

You can also use Kibana to visualize Nginx & Symfony logs by visiting `http://symfony.dev:81`.

# Code license

You are free to use the code in this repository under the terms of the 0-clause BSD license. LICENSE contains a copy of this license.
