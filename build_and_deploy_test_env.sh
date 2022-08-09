#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

mv dev.env .env
docker-compose down
docker-compose build
docker-compose up -d
docker-compose ps

sleep 30

set -e
EXIT_CODE=0
/bin/bash /home/bwalia/prepare_workspace_env.sh || EXIT_CODE=$?
echo $EXIT_CODE