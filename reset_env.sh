#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

#/bin/bash /home/bwalia/prepare_workspace_env.sh

rm -Rf ci4/

if docker ps --format '{{.Names}}' | egrep '^lamp-php74$' &> /dev/null; then
docker exec -it lamp-php74 chown -R www-data:www-data /var/www/html/writable/cache/
docker exec -it lamp-php74 chown -R www-data:www-data /var/www/html/writable/session/
fi

