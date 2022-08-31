#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

if [ -z "$1" ];
target_env=$1
then
  echo "env is not set"
  target_env="development"
fi

# cp -r ../webimpetus/* /tmp/$workdirname_file
# mv /tmp/$workdirname_file/dev.env /tmp/$workdirname_file/.env
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml down
# # docker-compose build
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml up -d --build
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml ps

# mv /tmp/$workdirname_file/prepare_workspace_env.sh .


if [[ "$target_env" == "production" ]]; then

cp -r ../webimpetus/* /home/bwalia/temp/prod/
cd /home/bwalia/temp/prod/
mv /home/bwalia/temp/prod/prod.env /home/bwalia/temp/prod/.env

docker-compose -f /home/bwalia/temp/prod/docker-compose.yml down
# docker-compose build
docker-compose -f /home/bwalia/temp/prod/docker-compose.yml up -d --build
docker-compose -f /home/bwalia/temp/prod/docker-compose.yml ps

else

if [[ "$target_env" == "development" ]]; then

docker-compose -f docker-compose.yml down
# docker-compose build
docker-compose -f docker-compose.yml up -d --build
docker-compose -f docker-compose.yml ps

bash ./reset_containers.sh $target_env

else
cp -r ../webimpetus/* /home/bwalia/temp/test/
cd /home/bwalia/temp/test/
mv /home/bwalia/temp/test/dev.env /home/bwalia/temp/test/.env
docker-compose -f /home/bwalia/temp/test/docker-compose.yml down
# docker-compose build
docker-compose -f /home/bwalia/temp/test/docker-compose.yml up -d --build
docker-compose -f /home/bwalia/temp/test/docker-compose.yml ps
fi
fi
#mv /tmp/prepare_workspace_env.sh .

# sleep 30

# #./reset_env.sh

# sudo -S rm -Rf ci4/
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/