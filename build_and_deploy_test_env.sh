#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

mv /tmp/webimpetus/dev.env /tmp/webimpetus/.env
docker-compose -f /tmp/webimpetus/docker-compose.yml down
# docker-compose build
docker-compose -f /tmp/webimpetus/docker-compose.yml up -d --build
docker-compose -f /tmp/webimpetus/docker-compose.yml ps

mv /tmp/webimpetus/prepare_workspace_env.sh .
# sleep 30

# #./reset_env.sh

# sudo -S rm -Rf ci4/
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/