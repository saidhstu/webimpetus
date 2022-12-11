#!/bin/bash

if [[ -z "$1" ]]; then
   echo "env is empty, so setting TARGET_ENV to prod (default)"
   TARGET_ENV="prod"
else
   echo "env is provided, so setting TARGET_ENV to $1"
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
   echo "IMAGE_TAG is empty, so setting IMAGE_TAG to install (default)"
   IMAGE_TAG="latest"
else
   echo "IMAGE_TAG is provided, IMAGE_TAG is set to $5"
   IMAGE_TAG=$5
fi

# clear; kubectl get pods,ing,svc -A
clear; ls -altr /helm-charts/

#cd /helm-charts/

#helm repo add stable https://charts.helm.sh/stable

helm uninstall wsl-$TARGET_ENV -n $TARGET_ENV

helm upgrade -i wsl-$TARGET_ENV \
/helm-charts/webimpetus-chart \
-f /helm-charts/webimpetus-chart/values-$TARGET_ENV-$CLUSTER_NAME.yaml \
--set-string targetImage="$DOCKER_IMAGE" \
--set-string targetImageTag="$IMAGE_TAG" \
--namespace $TARGET_ENV \
--create-namespace

#echo $helm_cmd

clear; helm ls -n $TARGET_ENV && kubectl get pods,ing,svc -n $TARGET_ENV
