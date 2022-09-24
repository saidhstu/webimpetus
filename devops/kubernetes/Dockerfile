FROM registry.workstation.co.uk/ci4-kubernetes:latest

apt update & apt upgrade -y && apt install -y \
    curl \
    # git \
    jq \
    vim \
    wget

COPY ci4 /var/www/html

# ENV DOCUMENT_ROOT=/var/www/html/public
# ENV PHP_INI=/usr/local/etc/php/php.ini

COPY devops/kubernetes/config/php/php.ini /usr/local/etc/php
#COPY devops/kubernetes/config/ssl /etc/apache2/ssl
COPY devops/kubernetes/config/vhosts /etc/apache2/sites-enabled
COPY logs/apache2 /var/log
#COPY logs/xdebug /var/log
