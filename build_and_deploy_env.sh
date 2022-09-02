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
# cp -r ../webimpetus/* /tmp/$workdirname_file
# mv /tmp/$workdirname_file/dev.env /tmp/$workdirname_file/.env
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml down
# # docker-compose build
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml up -d --build
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml ps

# mv /tmp/$workdirname_file/prepare_workspace_env.sh .
mkdir -p /tmp/webimpetus/
chmod 777 /tmp/webimpetus/

cp -r ../webimpetus/* /tmp/webimpetus/

if [[ "$target_env" == "production" ]]; then
target_env_short="prod"
else
# TEST
fi

mv /tmp/webimpetus/${target_env_short}.env /tmp/webimpetus/.env

if [[ "$target_env" == "development" ]]; then
target_env_short="dev"
bash ./reset_containers.sh $target_env

else
fi

cd /tmp/webimpetus/

docker-compose -f docker-compose.yml down
docker-compose -f docker-compose.yml up -d --build
docker-compose -f docker-compose.yml ps

if [[ "$target_env" == "development" ]]; then
chmod +x reset_containers.sh
/bin/bash reset_containers.sh $target_env
else
fi

#mv /tmp/prepare_workspace_env.sh .


# sleep 30

# #./reset_env.sh

# sudo -S rm -Rf ci4/
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/