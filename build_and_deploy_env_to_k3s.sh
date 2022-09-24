#!/bin/bash

############ This bash script deploys WebImpetus CI4 project (mariadb, php_lamp, phpmyadmin)
############ as kubernetes deployment into dev,test or prod environment using k3s.

set -x

SVC_HOST=localhost
SVC_NODEPORT=32180

TARGET_CLUSTER="k3s-rancher-desktop"

if [[ -z "$1" ]]; then
   echo "env is empty, so setting target_env to development (default)"
   target_env="dev"
else
   echo "env is NOT empty, so setting target_env to $1"
   target_env=$1
fi

if [[ -z "$2" ]]; then
   echo "action is empty, so setting action to start (default)"
   cicd_action="start"
else
   echo "action is NOT empty, so setting action to start (default)"
   cicd_action=$2
fi

if [[ "$target_env" == "dev" || "$target_env" == "test" || "$target_env" == "prod" ]]; then
echo "The target_env is $target_env supported by this script"
else
echo "Oops! The target_env is $target_env is not supported by this script, check the README.md and try again! (Hint: Try default value is dev)"
exit 1
fi

###### Set some variables
HOST_ENDPOINT_UNSECURE_URL="http://${SVC_HOST}:${SVC_NODEPORT}"

##### Set some variables
if [[ "$target_env" == "dev" ]]; then
WORKSPACE_DIR=$(pwd)
fi

if [[ "$target_env" == "test" || "$target_env" == "prod" ]]; then
WORKSPACE_DIR="/tmp/webimpetus/${target_env}"
mkdir -p ${WORKSPACE_DIR}
chmod 777 ${WORKSPACE_DIR}
rm -rf ${WORKSPACE_DIR}/*
cp -r ../webimpetus/* ${WORKSPACE_DIR}/
fi

if [[ "$target_env" == "dev" ]]; then
echo "No need to load kubeconfig use default"
fi

if [[ "$target_env" == "test" ]]; then
echo "Load test env kubeconfig"
export KUBECONFIG=/home/bwalia/.kube/k3s-test.yml
fi

if [[ "$target_env" == "prod" ]]; then
echo "Load prod env kubeconfig"
export KUBECONFIG=/home/bwalia/.kube/k3s-test.yml
fi


if [[ "$target_env" == "dev" ]]; then
echo "No need to move dev env files"
else
mv ${WORKSPACE_DIR}/${target_env}.env ${WORKSPACE_DIR}/.env
fi
cd ${WORKSPACE_DIR}/

if [[ "$cicd_action" == "stop" ]]; then
kubectl delete -f devops/kubernetes/workstation-deployment.yaml
fi

if [[ "$cicd_action" == "start" ]]; then
docker-compose -f "${WORKSPACE_DIR}/docker-compose.yml" build                #up -d --build
docker tag ${target_env}-workstation_webserver registry.workstation.co.uk/ci4-kubernetes:latest
docker push registry.workstation.co.uk/ci4-kubernetes:latest

#docker build -f devops/kubernetes/Dockerfile -t registry.workstation.co.uk/workstation:latest .
docker build -f devops/kubernetes/Dockerfile -t workstation .
docker tag workstation registry.workstation.co.uk/workstation:latest
docker push registry.workstation.co.uk/workstation:latest

kubectl delete -f devops/kubernetes/workstation-deployment.yaml
kubectl apply -f devops/kubernetes/workstation-deployment.yaml
fi

if [[ "$target_env" == "dev" && "$cicd_action" == "start" ]]; then
echo "Dev env action start"
fi

if [[ "$target_env" == "dev" && "$cicd_action" == "start" ]]; then

sleep 2

kubectl get pods -A

curl -IL $HOST_ENDPOINT_UNSECURE_URL
echo "Open Host endpoint..."

os_type=$(uname -s)

if [[ "$os_type" == "Darwin" ]]; then
open $HOST_ENDPOINT_UNSECURE_URL
fi

if [[ "$os_type" == "Linux" ]]; then
xdg-open $HOST_ENDPOINT_UNSECURE_URL
fi

fi

sleep 60






