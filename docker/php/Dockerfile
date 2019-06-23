#
# Riferimenti per la progettazione di questo file:
# - https://github.com/phusion/baseimage-docker/issues/319
# - https://github.com/LaraDock/laradock/issues/167

FROM php:7.1-fpm 

# Devo installare le dipendenze necessarie per far funzionare il driver MySQL.
RUN docker-php-ext-install pdo pdo_mysql
# Install prerequisites
RUN apt-get update && apt-get install -y curl
RUN apt-get install libcurl3-dev
RUN docker-php-ext-install curl

# Install correct locales
RUN apt-get update && apt-get install -y \
    locales \
    && printf 'en_GB.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'it_IT.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && locale-gen \
    && dpkg-reconfigure --frontend=noninteractive locales

ENV LANG it_IT.UTF-8
ENV LANGUAGE it_IT:en
ENV LC_ALL it_IT.UTF-8

# Install GIT required to work with composer
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git
    
# Install composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php    