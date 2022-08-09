#!/bin/bash
# This deploys CI4 project (mariadb, php_lamp, phpmyadmin) in docker container to test environment using docker compose.

set -x

/bin/bash /home/bwalia/prepare_workspace_env.sh