docker-symfony
==============

Just a litle Docker POC in order to have a complete stack for running Symfony into Docker containers using docker-compose tool.

# Installation

First, clone this repository:

```bash
$ git clone git@github.com:eko/docker-symfony.git
```

Next, put your Symfony application into `symfony` folder and do not forget to add `symfony.dev` in your `/etc/hosts` file.

Now, you have to build your Docker images:

```bash
$ docker build -t symfony/code code
$ docker build -t symfony/php-fpm php-fpm
$ docker build -t symfony/nginx nginx
```

Then, run:

```bash
$ docker-compose up
```

You are done, you can visit your Symfony application in `http://symfony.dev`

# How it works?

* `application`: This is the Symfony application code container,
* `db`: This is the MySQL database container (can be changed to postgresql or whatever in `docker-compose.yml` file),
* `php`: This is the PHP-FPM container in which the application volume is mounted,
* `nginx`: This is the Nginx webserver container in which application volume is mounted too.

This results in the following running containers:

```bash
> $ docker-compose ps
        Name                  Command          State              Ports
        ----------------------------------------------------------------------------------
        docker_application_1   /bin/bash               Up
        docker_db_1            /entrypoint.sh mysqld   Up      0.0.0.0:3306->3306/tcp
        docker_nginx_1         nginx                   Up      443/tcp, 0.0.0.0:80->80/tcp
        docker_php_1           php5-fpm -F             Up      9000/tcp
```

# Read logs / Kibana

You can access Nginx and Symfony application logs in the following directories into your host machine:

* `logs/nginx`
* `logs/symfony`

You can also uncomment the `elk` container section in `docker-compose.yml` in order to enable the [willdurand/elk](https://www.github.com/willdurand/docker-elk) image.
