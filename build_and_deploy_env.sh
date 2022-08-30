#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

if [ -z "$1" ];
then
  echo "env is not set"
  exit 1
fi


# cp -r ../webimpetus/* /tmp/$workdirname_file
# mv /tmp/$workdirname_file/dev.env /tmp/$workdirname_file/.env
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml down
# # docker-compose build
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml up -d --build
# docker-compose -f /tmp/$workdirname_file/docker-compose.yml ps

# mv /tmp/$workdirname_file/prepare_workspace_env.sh .


if [[ "$1" == "production" ]]; then

cp -r ../webimpetus/* /tmp/prod
mkdir -p /tmp/prod
mv /tmp/prod/prod.env /tmp/prod/test/.env
docker-compose -f /tmp/prod/docker-compose.yml down
# docker-compose build
docker-compose -f /tmp/prod/docker-compose.yml up -d --build
docker-compose -f /tmp/prod/docker-compose.yml ps

else

cp -r ../webimpetus/* /tmp/test
mkdir -p /tmp/test
mv /tmp/test/dev.env /tmp/test/.env
docker-compose -f /tmp/test/docker-compose.yml down
# docker-compose build
docker-compose -f /tmp/test/docker-compose.yml up -d --build
docker-compose -f /tmp/test/docker-compose.yml ps
fi
#mv /tmp/prepare_workspace_env.sh .

# sleep 30

# #./reset_env.sh

# sudo -S rm -Rf ci4/
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# sudo -S rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/