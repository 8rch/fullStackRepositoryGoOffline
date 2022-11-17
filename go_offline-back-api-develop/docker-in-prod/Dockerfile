FROM php:7.2-apache

RUN dpkg --configure -a

RUN apt-get update && \
    apt-get install -y software-properties-common && \
    rm -rf /var/lib/apt/lists/*

RUN apt-get update -y && apt-get install -y sendmail libpng-dev
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN apt-get update; \
    apt-get install -y libpq5 libpq-dev; \
    docker-php-ext-install pdo pdo_pgsql; \
    apt-get autoremove --purge -y libpq-dev; \
    apt-get clean ; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

RUN php -r "readfile('https://getcomposer.org/installer');" | php

RUN a2enmod rewrite
COPY . /var/www/html
RUN php composer global require "fxp/composer-asset-plugin:^1.4.1"
RUN php composer.phar install
VOLUME .:/var/www/html
VOLUME /var/www/html

RUN php ./yii migrate --migrationPath=console/migrations/auth/ --interactive=0
RUN php ./yii migrate --interactive=0
RUN chmod -R 777 /var/www/html/backend/runtime
RUN chmod -R 777 /var/www/html/backend/web/assets
CMD ["apache2-foreground"]