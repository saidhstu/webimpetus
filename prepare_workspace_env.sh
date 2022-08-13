#!/bin/bash
set -x

# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/ci4/writable/
# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data/

#mv dev.env .env
mkdir -p /tmp/webimpetus/
cp -r ../webimpetus/* /tmp/webimpetus
