#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

cp dev.env .env
docker-compose down
docker-compose build
docker-compose up -d
docker-compose ps

sleep 30

docker cp /home/bwalia/env_webimpetus_dev_ci4baseimagetest lamp-php74:/var/www/html/.env

./reset_env.sh