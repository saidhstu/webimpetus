#!/bin/bash

set -x

scp -r app/ bwalia@192.168.0.69:/home/bwalia/projects/webimpetus/app/

/bin/bash prepare_test_environment.sh

#kubectl delete -f /var/www/html/writable/tizohub_deployments/service-$SERVICE_ID.yaml

aws sts get-caller-identity
export KUBECONFIG=/home/bwalia/.kube/k3s-test.yml

helm upgrade -f devops/webimpetus-chart/values-test.yaml -i ci4baseimagetest ./devops/webimpetus-chart --set=image.tag=$IMAGE_TAG

kubectl get all -A
