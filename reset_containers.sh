#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

if [[ -z "$1" ]]; then
   echo "env is empty, so setting target_env to development (default)"
   target_env="development"
else
   echo "env is NOT empty, so setting target_env to $1"
   target_env=$1
fi

target_env_short=$target_env

sleep 5

DATE_GEN_VERSION=$(date +"%Y%m%d%I%M%S")
export DATE_GEN_VERSION=$(date +"%Y%m%d%I%M%S")

mkdir /tmp
touch /tmp/.env
#PROD
if [[ "$target_env" == "production" ]]; then
target_env_short="prod"
echo APP_DEPLOYED_AT=$DATE_GEN_VERSION >> /home/bwalia/env_webimpetus_myworkstation
docker cp /home/bwalia/env_webimpetus_myworkstation ${target_env_short}-workstation-php74:/var/www/html/.env

else
# DEV
if [[ "$target_env" == "development" ]]; then
target_env_short="dev"
cp ${HOME}/env_webimpetus_myworkstation /tmp/.env
echo APP_DEPLOYED_AT=$DATE_GEN_VERSION >> /tmp/.env

else
# TEST
cp /home/bwalia/env_webimpetus_dev_ci4baseimagetest /tmp/.env
echo APP_DEPLOYED_AT=$DATE_GEN_VERSION >> /tmp/.env

fi
fi

docker cp /tmp/.env ${target_env_short}-workstation-php74:/var/www/html/.env

docker exec ${target_env_short}-workstation-php74 chown -R www-data:www-data /var/www/html/writable/
docker exec ${target_env_short}-workstation-php74 composer update

