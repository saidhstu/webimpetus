ARG TAG=latest

FROM registry.workstation.co.uk/webimpetus:$TAG

RUN apt update && apt upgrade -y && apt install -y \
    curl \
    # git \
    jq \
    vim \
    wget

COPY ci4 /var/www/html

# ENV DOCUMENT_ROOT=/var/www/html/public
# ENV PHP_INI=/usr/local/etc/php/php.ini

COPY config/php/php.ini /usr/local/etc/php
#COPY devops/kubernetes/config/ssl /etc/apache2/ssl
#COPY config/vhosts/default.conf /etc/apache2/sites-enabled/default.conf
COPY logs/apache2/* /var/log
#COPY logs/xdebug /var/log
