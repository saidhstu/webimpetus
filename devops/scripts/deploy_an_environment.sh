#!/bin/bash

#set -x

if [[ -z "$1" ]]; then
   echo "TARGET_ENV is empty, so setting TARGET_ENV to prod (default)"
   TARGET_ENV="prod"
else
   echo "TARGET_ENV is provided, so setting TARGET_ENV to $1"
   TARGET_ENV=$1
fi

if [[ -z "$2" ]]; then
   echo "CLUSTER_NAME is empty, so setting CLUSTER_NAME to k3s1 (default)"
   CLUSTER_NAME="k3s1"
else
   echo "CLUSTER_NAME is provided, so setting CLUSTER_NAME to $2"
   CLUSTER_NAME=$2
fi

if [[ -z "$3" ]]; then
   echo "DOCKER_IMAGE is empty, so setting DOCKER_IMAGE to install (default)"
   DOCKER_IMAGE="registry.workstation.co.uk/webimpetus"
else
   echo "DOCKER_IMAGE is provided, DOCKER_IMAGE is set to $3"
   DOCKER_IMAGE=$3
fi

if [[ -z "$4" ]]; then
   echo "DOCKER_IMAGE is empty, so setting DOCKER_IMAGE to install (default)"
   DOCKER_IMAGE="registry.workstation.co.uk/webimpetus"
else
   echo "DOCKER_IMAGE is provided, DOCKER_IMAGE is set to $4"
   DOCKER_IMAGE=$4
fi

if [[ -z "$5" ]]; then
   echo "TARGET_CLUSTER_KUBECONFIG is empty, so setting TARGET_CLUSTER_KUBECONFIG to empty (default)"
   TARGET_CLUSTER_KUBECONFIG=""
else
   echo "TARGET_CLUSTER_KUBECONFIG is provided, TARGET_CLUSTER_KUBECONFIG is set to $5"
   TARGET_CLUSTER_KUBECONFIG=$5
fi

BASH_FILE_TO_RUN=devops/scripts/kube_runner_deploy_env.sh

DOCKER_CONRAINER_NAME=kube-runner-workstation

# if [[ $TRIGGER_ENV == "dev" ]]; then
# docker container stop $DOCKER_CONRAINER_NAME
# docker container rm $DOCKER_CONRAINER_NAME
# fi

docker run --name $DOCKER_CONRAINER_NAME -v $(pwd)/devops/webimpetus-chart:/helm-charts/webimpetus-chart \
--env KUBECONFIG_BASE64=$TARGET_CLUSTER_KUBECONFIG \
--env RUN_BASH_BASE64=$(cat $BASH_FILE_TO_RUN | base64) \
registry.workstation.co.uk/kube-runner:stable