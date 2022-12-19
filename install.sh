#!/bin/bash

# This bash script deploys the WebImpetus CI4 docker image to the target kubernetes cluster.
# as kubernetes deployment into dev,test or prod environment using k3s.

#  set -x

if [[ -z "$1" ]]; then
   echo "env is empty, so setting targetEnv to development (default)"
   targetEnv="dev"
else
   echo "env is NOT empty, so setting targetEnv to $1"
   targetEnv=$1
fi

if [[ -z "$2" ]]; then
   echo "targetNs is empty, so setting it to default (dev)"
   targetNs="dev"
else
   echo "targetNs is provided, so setting it to $2"
   targetNs=$2
fi

if [[ -z "$3" ]]; then
   echo "IMAGE_TAG is empty, so setting it to default (latest)"
   IMAGE_TAG=""
else
   echo "IMAGE_TAG is provided, so setting it to $3"
   IMAGE_TAG=$3
fi

if [[ -z "$4" ]]; then
   echo "build_environment is empty, so setting it to default (empty)"
   build_environment=""
else
   echo "build_environment is provided, so setting it to $4"
   build_environment=$4
fi

if [[ "$build_environment" == "build" ]]; then
   sh ./build.sh $targetEnv $targetEnv $deployment_tooling
fi

IMAGE_TAG="dev"

if [[ "$targetEnv" == "dev" || "$targetEnv" == "dev-bwalia" || "$targetEnv" == "int" || "$targetNs" == "test" || "$targetEnv" == "acc" || "$targetEnv" == "prod" ]]; then
   sh ./helper_tools/helm_deploy_webimpetus.sh $targetEnv $targetEnv install $IMAGE_TAG
else
   echo "Environment $targetEnv is not supported by this script, check the README.md and try again! (Hint: Try default value is dev)"
fi