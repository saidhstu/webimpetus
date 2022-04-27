#!/usr/bin/env bash
# -- Author: Balinder Walia --
# -- Pushes the docker image : webimpetus into AWS ECR / or optionally into a given Docker registry --
# -- $1 is mandatory image version, for example : latest --

set -x

cp /Users/jack/Downloads/webimpetus.sql /Users/jack/www/webimpetus/devops/init/01.sql
cp /Users/jack/Downloads/webimpetus.env /Users/jack/www/webimpetus/env

docker build -t jackcunningham/webimpetus-ci4 -f devops/docker/Dockerfile .

docker-compose -f devops/docker-compose.yaml down
docker-compose -f devops/docker-compose.yaml up -d --build

#sleep 600
#rm -Rf devops/init/01.sql
#rm -Rf /Users/jack/www/webimpetus/env