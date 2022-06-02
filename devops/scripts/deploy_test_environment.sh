#!/bin/bash

set -x
aws sts get-caller-identity
export KUBECONFIG=/home/bwalia/.kube/k3s-test.yml

helm upgrade -f devops/webimpetus-chart/values-test.yaml -i ci4baseimagetest ./devops/webimpetus-chart --set=image.tag=$IMAGE_TAG