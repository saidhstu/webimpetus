#!/bin/bash

############ This bash script deploys WebImpetus CI4 project (mariadb, php_lamp, phpmyadmin)
############ as kubernetes deployment into dev,test or prod environment using k3s.

#   set -x

echo "Deploy WebImpetus via helm:"

if [[ -z "$1" ]]; then
echo "KUBECONFIG is empty, so leaving default set KUBECONFIG to whatever it may be (default)"
else
echo "KUBECONFIG is provided, so setting KUBECONFIG $1"
export KUBECONFIG=$1
fi

if [[ -z "$2" ]]; then
   echo "env is empty, so setting targetEnv to development (default)"
   targetEnv="dev"
else
   echo "env is provided, so setting targetEnv to $2"
   targetEnv=$2
fi

if [[ -z "$3" ]]; then
   echo "namespace is empty, so setting namespace to dev (default)"
   targetNs="dev"
else
   echo "namespace is provided, so setting namespace to $3"
   targetNs=$3
fi

if [[ -z "$4" ]]; then
echo "TARGET_CLUSTER is default, so leaving default set TARGET_CLUSTER to whatever it may be (default k3s0})"
export TARGET_CLUSTER="k3s0"
else
echo "TARGET_CLUSTER is provided, so setting TARGET_CLUSTER $4"
export TARGET_CLUSTER=$4
fi

if [[ -z "$5" ]]; then
   echo "docker image is empty, so setting docker base image name set to webimpetus (default)"
   IMAGE_NAME="webimpetus"
else
   echo "docker image is provided, docker image name is set to $5"
   IMAGE_NAME=$5
fi

if [[ -z "$6" ]]; then
echo "VIRTUAL_HOST is empty, so leaving default set VIRTUAL_HOST to whatever it may be (default localhost)"
export VIRTUAL_HOST="localhost"
else
echo "VIRTUAL_HOST is provided, so setting VIRTUAL_HOST $6"
export VIRTUAL_HOST=$6
fi

if [[ -z "$7" ]]; then
echo "Docker build cmd is default, so leaving default set BUILD_IMAGE_TOOL to whatever it may be (nerdctl)"
export BUILD_IMAGE_TOOL="docker"
else
echo "BUILD_IMAGE_TOOL is provided, so setting BUILD_IMAGE_TOOL $7"
export BUILD_IMAGE_TOOL=$7
fi

if [[ -z "$8" ]]; then
   echo "action is empty, so setting action to install (default)"
   deployment_stage="install"
else
   echo "action is provided, action is set to $8"
   deployment_stage=$8
fi

VALUES_FILE_PATH=values-${targetNs}-${TARGET_CLUSTER}.yaml

IMAGE_REGISTRY=registry.workstation.co.uk
IMAGE_TAG=latest

helm_cmd=$(echo upgrade --install -f devops/webimpetus-chart/${VALUES_FILE_PATH} wsl-${targetNs} devops/webimpetus-chart/ --set-string targetImage="${IMAGE_REGISTRY}/${IMAGE_NAME}" --set-string targetImageTag="${IMAGE_TAG}" --namespace ${targetNs} --create-namespace)
echo "helm $helm_cmd"
# exit 0
helm $helm_cmd

