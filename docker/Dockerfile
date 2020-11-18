FROM php:7.4-apache

ARG APP_DOMAIN
ARG GITHUB_TOKEN
ARG MYSQL_PORT
ARG MYSQL_HOST

ADD . /var/www


RUN chmod 777 /var/www/docker/deploy.sh
RUN chmod 777 /var/www/docker/run.sh
RUN bash /var/www/docker/deploy.sh $APP_DOMAIN $GITHUB_TOKEN $MYSQL_HOST $MYSQL_PORT

RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN apt-get update && \
     apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip


RUN mkdir -p /var/run/sshd
ENTRYPOINT ["/var/www/docker/run.sh"]
