# PULL openresty119php74 BASE IMAGE AND PUSH DEPLOYMENT
FROM docker.io/bwalia/openresty119php74:latest

COPY devops/docker/setup.sh /
RUN chmod +x /setup.sh
RUN sh /setup.sh

ADD . /var/www/html/

COPY devops/docker/nginx.conf /usr/local/openresty/nginx/conf/nginx.conf

RUN rm -rf /var/www/html/devops/
RUN rm -rf /var/www/html/*.sql
RUN rm -rf /var/www/html/buildspec.yaml

# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html

RUN cd /var/www/html && composer update

RUN mv /var/www/html/env /var/www/html/.env

RUN chown www-data:root -R /var/www/html/
RUN chmod 775 -R /var/www/html/
RUN chmod 777 -Rv /var/www/html/writable

RUN mkdir -p /var/php

RUN apk add supervisor

COPY devops/docker/supervisord.conf /etc/

ENTRYPOINT /usr/bin/supervisord -c /etc/supervisord.conf

STOPSIGNAL SIGQUIT