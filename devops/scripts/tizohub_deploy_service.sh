#!/bin/bash

set -x

kubectl get pods

kubectl apply -f /var/www/html/writable/tizohub_deployments/service-2.yaml

kubectl get pods