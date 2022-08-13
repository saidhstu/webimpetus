#!/bin/bash
set -x

# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data
# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/config
# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/ci4/writable/
# rm -Rf /home/bwalia/actions-runner-webimpetus/_work/webimpetus/webimpetus/data/

day=$(date +%Y_%m_%d_%H_%M)
workdirname="WebImpetus"
workdirname_file="$workdirname-$day"
export workdirname_file="$workdirname_file"

#mv dev.env .env
#rm -Rf /tmp/$workdirname_file/
mkdir -p /tmp/$workdirname_file/
chmod -R 777 /tmp/$workdirname_file/

cp -r ../webimpetus/* /tmp/$workdirname_file
