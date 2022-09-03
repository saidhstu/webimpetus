#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

if [[ -z "$1" ]]; then
   echo "env is empty, so setting target_env to development (default)"
   target_env="dev"
else
   echo "env is NOT empty, so setting target_env to $1"
   target_env=$1
fi

sleep 1

docker exec ${target_env}-workstation-php74 composer update
docker exec ${target_env}-workstation-php74 chown -R www-data:www-data /var/www/html/writable/

DATE_GEN_VERSION=$(date +"%Y%m%d%I%M%S")
export DATE_GEN_VERSION=$(date +"%Y%m%d%I%M%S")

if [[ "$target_env" == "dev" ]]; then

APP_RELEASE_NOTES_DOC_URL="https://webimpetus.dev/docs/app_release_notes"

fi

if [[ "$target_env" == "test" ]]; then

APP_RELEASE_NOTES_DOC_URL="https://test.webimpetus.dev/docs/app_release_notes"

fi

if [[ "$target_env" == "prod" ]]; then

APP_RELEASE_NOTES_DOC_URL="https://webimpetus.cloud/docs/"

fi

export APP_RELEASE_NOTES_DOC_URL=$APP_RELEASE_NOTES_DOC_URL

echo "App environment: $target_env"
echo "Date generated version: $DATE_GEN_VERSION"
echo "App release notes doc url is $APP_RELEASE_NOTES_DOC_URL"

mkdir -p /tmp
touch /tmp/${target_env}.env
truncate -s 0 /tmp/${target_env}.env

#  DEV   
if [[ "$target_env" == "dev" ]]; then
   cp ${HOME}/env_webimpetus_myworkstation /tmp/${target_env}.env
fi
   
cp /home/bwalia/env_webimpetus_${target_env}_myworkstation /tmp/${target_env}.env

echo APP_DEPLOYED_AT=$DATE_GEN_VERSION >> /tmp/${target_env}.env
echo APP_ENVIRONMENT=$target_env >> /tmp/${target_env}.env
echo APP_RELEASE_NOTES_DOC_URL=$APP_RELEASE_NOTES_DOC_URL >> /tmp/${target_env}.env

docker cp /tmp/${target_env}.env ${target_env}-workstation-php74:/var/www/html/.env

if [[ "$target_env" == "dev" ]]; then
# What OS are you using?
docker exec ${target_env}-workstation-php74 cat /etc/os-release
docker exec ${target_env}-workstation-php74 apt update 
docker exec ${target_env}-workstation-php74 apt upgrade
docker exec ${target_env}-workstation-php74 apt install git vim -y
fi
