#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

docker cp /home/bwalia/env_webimpetus_dev_ci4baseimagetest lamp-php74:/var/www/html/.env
docker exec lamp-php74 chown -R www-data:www-data /var/www/html/writable/
docker exec lamp-php74 composer update

