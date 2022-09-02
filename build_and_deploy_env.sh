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
if [[ "$target_env" == "production" ]]; then
target_env_short="prod"
fi

if [[ "$target_env" == "development" ]]; then

target_env_short="dev"
docker-compose -f docker-compose.yml down
# docker-compose build
docker-compose -f docker-compose.yml up -d --build
docker-compose -f docker-compose.yml ps

bash ./reset_containers.sh $target_env

else

cp -r ../webimpetus/* /home/bwalia/temp/${target_env_short}/
cd /home/bwalia/temp/${target_env_short}/
mv /home/bwalia/temp/${target_env_short}/dev.env /home/bwalia/temp/${target_env_short}/.env
docker-compose -f /home/bwalia/temp/${target_env_short}/docker-compose.yml down
# docker-compose build
docker-compose -f /home/bwalia/temp/${target_env_short}/docker-compose.yml up -d --build
docker-compose -f /home/bwalia/temp/${target_env_short}/docker-compose.yml ps

fi

#mv /tmp/prepare_workspace_env.sh .

# sleep 30

# #./reset_env.sh

# sudo -S rm -Rf ci4/
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/