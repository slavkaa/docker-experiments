FROM php:8.0-apache
RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update
RUN apt upgrade -y
RUN apt-get install -y libzip-dev
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y iputils-ping
RUN apt-get install -y mycli
RUN rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
