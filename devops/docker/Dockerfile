FROM 123154119074.dkr.ecr.eu-west-2.amazonaws.com/tizoinfra/tizohub:base

# Copy nginx configuration files
COPY devops/docker/nginx.conf /usr/local/openresty/nginx/conf/nginx.conf
COPY devops/docker/index.php /usr/local/openresty/nginx/html/index.php
#COPY tenants_infra_manager /var/www/html/tenants_infra_manager/
ADD . /var/www/html/appstarter/
RUN rm -rf /var/www/html/appstarter/devops/

# Change permissions in directory /var/www/html to belong to www-data (PHP) 
RUN chown -R www-data:www-data /var/www/html
# Set permissions to allow only user www-data (PHP) to access 
RUN chmod 755 /var/www/html/

COPY devops/docker/php-fpm-7.conf /usr/local/etc/php-fpm.conf
COPY devops/docker/php.ini /usr/local/etc/php/conf.d/php.ini

#Prepare dir for PHP unix socket etc
COPY devops/docker/setup.sh /
RUN chmod +x /setup.sh
RUN sh /setup.sh

# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html/appstarter

#RUN cd /var/www/html && composer create-project codeigniter4/appstarter
RUN cd /var/www/html/appstarter && composer update

RUN mkdir -p /var/php

#CMD ["/usr/local/sbin/php-fpm --nodaemonize --fpm-config /usr/local/etc/php-fpm.conf"]
#CMD [ "php-fpm" ]

#CMD ["/usr/local/openresty/bin/openresty", "-g", "daemon off;"]
COPY devops/docker/start.sh /

RUN chmod +x /start.sh
CMD sh /start.sh

#CMD ["/usr/local/openresty/bin/openresty", "-g", "daemon off;"]

RUN apk add supervisor
COPY devops/docker/supervisord.conf /etc/

ENTRYPOINT /usr/bin/supervisord -c /etc/supervisord.conf

EXPOSE 80

# Use SIGQUIT instead of default SIGTERM to cleanly drain requests
# See https://github.com/openresty/docker-openresty/blob/master/README.md#tips--pitfalls

STOPSIGNAL SIGQUIT

