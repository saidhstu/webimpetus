ARG TAG=latest

#FROM registry.workstation.co.uk/openresty-php:$TAG
FROM bwalia/openresty-php:$TAG

RUN apk update && apk upgrade \
     jq
     
COPY ci4 /src

#COPY ./config/php/php.ini /usr/local/etc/php/php.ini
COPY ./config/vhosts/wsl_server.conf /etc/nginx/sites-enabled/wsl_server.conf
COPY ./config/vhosts/nginx.conf /usr/local/openresty/nginx/conf/nginx.conf
     #RUN sed -i "s|listen = 127.0.0.1:9000|listen = 127.0.0.1:9000\nlisten = /var/run/php-fpm/www.sock|g" /usr/local/etc/php-fpm.d/www.conf