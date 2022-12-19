#!/bin/bash

# This bash script build WebImpetus CI4 docker image.
# as kubernetes deployment into dev,test or prod environment using k3s.

#  set -x

if ! docker info > /dev/null 2>&1; then
  echo "This script uses docker, and it isn't running - please start docker and try again!"
  exit 1
fi

DATE_GEN_VERSION=$(date +"%Y%m%d%I%M%S")

IMAGE_NAME="webimpetus"
IMAGE_TAG="dev"
IMAGE_REPO="registry.workstation.co.uk"
TARGET_NAMESPACE="dev"

HTTP_SERVER_TYPE="openresty"

build_process="enabled"
#build_process="disabled"

if [ -z "$1" ]; then
   echo "env is empty, so setting targetEnv to development (default)"
   targetEnv="dev"
else
   echo "env is NOT empty, so setting targetEnv to $1"
   targetEnv=$1
fi

if [ -z "$2" ]; then
   echo "TARGET_NAMESPACE is empty, so setting it to $TARGET_NAMESPACE (default value is: dev)"
else
   echo "TARGET_NAMESPACE is provided, so using it $TARGET_NAMESPACE"
   TARGET_NAMESPACE=$2
fi

if [ -z "$3" ]; then
   echo "IMAGE_TAG is empty, so setting it to $IMAGE_TAG (default value is: latest)"
else
   echo "IMAGE_TAG is provided, so using it $IMAGE_TAG"
   IMAGE_TAG=$3
fi

if [ -z "$4" ]; then
echo "Docker build cmd is set default (docker, nerdctl etc.)"
BUILD_IMAGE_TOOL="docker"
else
echo "BUILD_IMAGE_TOOL is provided, so setting BUILD_IMAGE_TOOL $4"
BUILD_IMAGE_TOOL=$4
fi

if [ -z "$4" ]; then
echo "next_step is empty, so setting action to default (install)"
next_step="install"
else
echo "next_step is provided, so setting action to $4"
next_step=$4
fi

if [ $targetEnv == "dev" || $targetEnv == "dev-bwalia" ]; then
echo "BUILD_IMAGE_TOOL is empty, exiting!"
   if [ "$IMAGE_TAG" == "" ]; then
   IMAGE_TAG=$targetEnv
      echo "IMAGE_TAG is set to $targetEnv"
   else
      echo "IMAGE_TAG is $IMAGE_TAG"
   fi
fi

if [ "$build_process" == "disabled" ]; then
   echo "Temporary added to disable image build process"
else
   ${BUILD_IMAGE_TOOL} build -f devops/docker/Dockerfile --build-arg BASE_TAG=latest -t local-${IMAGE_NAME} . --no-cache
   ${BUILD_IMAGE_TOOL} tag local-${IMAGE_NAME} ${IMAGE_REPO}/${IMAGE_NAME}:${IMAGE_TAG}
   ${BUILD_IMAGE_TOOL} push  ${IMAGE_REPO}/${IMAGE_NAME}:${IMAGE_TAG}
fi

if [ "$next_step" == "install" ]; then
   ./install.sh $targetEnv $TARGET_NAMESPACE $IMAGE_TAG
   echo "$targetEnv $TARGET_NAMESPACE Done!"
   exit 0
else
   echo "Done!"
   exit 0
fi
