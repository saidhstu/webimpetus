#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

if [ -z "$1" ];
then
  echo "env is not set"
  exit 1
fi

sleep 10

if [[ "$1" == "production" ]]; then

docker cp /home/bwalia/env_webimpetus_myworkstation lamp-php74:/var/www/html/.env
docker exec prod-workstation-php74 chown -R www-data:www-data /var/www/html/writable/
docker exec prod-workstation-php74 composer update

else

docker cp /home/bwalia/env_webimpetus_dev_ci4baseimagetest lamp-php74:/var/www/html/.env
docker exec test-workstation-php74 chown -R www-data:www-data /var/www/html/writable/
docker exec test-workstation-php74 composer update

fi