# PULL BASE IMAGE AND PUSH DEPLOYMENT
FROM docker.io/bwalia/openresty119php74:latest

ADD . /var/www/html/

RUN rm -rf /var/www/html/devops/
RUN rm -rf /var/www/html/*.sql
RUN rm -rf /var/www/html/buildspec.yaml

# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html

#RUN cd /var/www/html && composer create-project codeigniter4/appstarter
RUN cd /var/www/html && composer update
