#!/bin/bash

############ This bash script deploys WebImpetus CI4 project (mariadb, php_lamp, phpmyadmin)
############ as kubernetes deployment into dev,test or prod environment using k3s.

#   set -x

SVC_HOST=localhost
SVC_NODEPORT=32080

DATE_GEN_VERSION=$(date +"%Y%m%d%I%M%S")

TARGET_CLUSTER="k3s-rancher-desktop"

if [[ -z "$1" ]]; then
   echo "env is empty, so setting targetEnv to development (default)"
   targetEnv="dev"
else
   echo "env is NOT empty, so setting targetEnv to $1"
   targetEnv=$1
fi

if [[ -z "$2" ]]; then
   echo "action is empty, so setting action to start (default)"
   cicd_action="start"
else
   echo "action is NOT empty, action is set to $2"
   cicd_action=$2
fi

if [[ -z "$3" ]]; then
   echo "k3s deployment tool type is empty, so setting k3s_deployment_tool to helm (default)"
   k3s_deployment_tool="helm"
else
   echo "k3s deployment tool type is NOT empty, k3s_deployment_tool is set to $3"
   k3s_deployment_tool=$3
fi

if [[ -z "$4" ]]; then
   echo "docker base image is empty, so setting docker base image to dev-wsl_webserver (default)"
   docker_base_image="${targetEnv}-wsl_webserver"
else
   echo "docker base image type is NOT empty, docker base image is set to $4"
   docker_base_image=$4
fi


if [[ "$targetEnv" == "dev" || "$targetEnv" == "dev-bwalia" || "$targetEnv" == "test" || "$targetEnv" == "prod" ]]; then
echo "The targetEnv is $targetEnv supported by this script"
else
echo "Oops! The targetEnv is $targetEnv is not supported by this script, check the README.md and try again! (Hint: Try default value is dev)"
exit 1
fi

###### Set some variables
HOST_ENDPOINT_UNSECURE_URL="http://${SVC_HOST}:${SVC_NODEPORT}"

if [[ "$targetEnv" == "dev" ]]; then
APP_RELEASE_NOTES_DOC_URL="https://webimpetus.dev/docs/app_release_notes"
fi

if [[ "$targetEnv" == "test" ]]; then
APP_RELEASE_NOTES_DOC_URL="https://test.webimpetus.dev/docs/app_release_notes"
fi

if [[ "$targetEnv" == "prod" ]]; then
APP_RELEASE_NOTES_DOC_URL="https://webimpetus.cloud/docs/"
fi

export APP_RELEASE_NOTES_DOC_URL=$APP_RELEASE_NOTES_DOC_URL

##### Set some variables
if [[ "$targetEnv" == "dev" || "$targetEnv" == "dev-bwalia" ]]; then
WORKSPACE_DIR=$(pwd)
fi

if [[ "$targetEnv" == "test" || "$targetEnv" == "prod" ]]; then
WORKSPACE_DIR="/tmp/webimpetus/${targetEnv}"
mkdir -p ${WORKSPACE_DIR}
chmod 777 ${WORKSPACE_DIR}
rm -rf ${WORKSPACE_DIR}/*
cp -r ../webimpetus/* ${WORKSPACE_DIR}/
fi

if [[ "$targetEnv" == "dev" ]]; then
echo "No need to load kubeconfig use default"
fi

if [[ "$targetEnv" == "test" ]]; then
echo "Load test env kubeconfig"
export KUBECONFIG=/home/bwalia/.kube/k3s-test.yml
fi

if [[ "$targetEnv" == "prod" ]]; then
echo "Load prod env kubeconfig"
export KUBECONFIG=/home/bwalia/.kube/k3s-test.yml
fi


if [[ "$targetEnv" == "dev" ]]; then
echo "No need to move dev env files"
else
mv ${WORKSPACE_DIR}/${targetEnv}.env ${WORKSPACE_DIR}/.env
fi
cd ${WORKSPACE_DIR}/

if [[ "$cicd_action" == "stop" ]]; then
kubectl delete -f devops/kubernetes/wsldeployment.yaml
fi

if [[ "$cicd_action" == "start" ]]; then
# this builds the image name 
#docker rmi -f $(docker images -aq)
docker-compose -f "${WORKSPACE_DIR}/docker-compose.yml" build                #up -d --build
docker tag ${docker_base_image} registry.workstation.co.uk/webimpetus:${DATE_GEN_VERSION}
docker push registry.workstation.co.uk/webimpetus:${DATE_GEN_VERSION}

#docker build -f devops/kubernetes/Dockerfile -t registry.workstation.co.uk/workstation:latest .
docker build -f devops/kubernetes/Dockerfile --build-arg TAG=${DATE_GEN_VERSION}  -t workstation .
docker tag workstation registry.workstation.co.uk/workstation:${DATE_GEN_VERSION}
docker push registry.workstation.co.uk/workstation:${DATE_GEN_VERSION}

# this deploys the image to k3s

if [[ "$k3s_deployment_tool" == "helm" ]]; then
#helm upgrade --install workstation --set image.tag=${DATE_GEN_VERSION} --set image.repository=registry.workstation.co.uk/workstation --set ingress.hosts[0].host=${HOST_ENDPOINT_UNSECURE_URL} --set ingress.hosts[0].paths[0]=/ --set ingress.hosts[0].paths[1]=/docs --set ingress.hosts[0].paths[2]=/docs/app_release_notes --set ingress.hosts[0].paths[3]=/docs/app_release_notes/${DATE_GEN_VERSION} --set ingress.hosts[0].paths[4]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus --set ingress.hosts[0].paths[5]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv} --set ingress.hosts[0].paths[6]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus --set ingress.hosts[0].paths[7]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv} --set ingress.hosts[0].paths[8]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus --set ingress.hosts[0].paths[9]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus/${targetEnv} --set ingress.hosts[0].paths[10]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus --set ingress.hosts[0].paths[11]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus/${targetEnv} --set ingress.hosts[0].paths[12]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/webimpetus --set ingress.hosts[0].paths[13]=/docs/app_release_notes/${DATE_GEN_VERSION}/webimpetus/${targetEnv}/webimpetus/${targetEnv}/web
helm uninstall wsl-${targetEnv} -n ${targetEnv}
###helm upgrade --install -f devops/webimpetus-chart/values-${targetEnv}.yaml wsl-${targetEnv} ./devops/webimpetus-chart --set image=registry.workstation.co.uk/workstation:${DATE_GEN_VERSION} --namespace ${targetEnv}
helm upgrade --install -f devops/webimpetus-chart/values-${targetEnv}.yaml wsl-${targetEnv} ./devops/webimpetus-chart --set-string targetImageTag="${DATE_GEN_VERSION}" --namespace ${targetEnv}
else
kubectl delete -f devops/kubernetes/wsldeployment.yaml
kubectl apply -f devops/kubernetes/wsldeployment.yaml
fi

sleep 60 # wait for 60 seconds for the k3s deployment to be ready
kubectl get pods -A
fi

if [[ "$targetEnv" == "dev" && "$cicd_action" == "start" ]]; then
echo "Dev env action start"

sleep 10 # wait for 10 seconds for the dev deployment to be ready

echo "Waiting for services to start..."

curl -IL $HOST_ENDPOINT_UNSECURE_URL -H "Host: my.workstation.co.uk"
os_type=$(uname -s)

if [[ "$os_type" == "Darwin" ]]; then
open $HOST_ENDPOINT_UNSECURE_URL
fi

if [[ "$os_type" == "Linux" ]]; then
xdg-open $HOST_ENDPOINT_UNSECURE_URL
fi

fi





