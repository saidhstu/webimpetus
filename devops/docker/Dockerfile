# PULL BASE IMAGE AND PUSH DEPLOYMENT
FROM docker.io/bwalia/openresty119php74:latest

ADD . /var/www/html/

RUN rm -rf /var/www/html/devops/
RUN rm -rf /var/www/html/*.sql
RUN rm -rf /var/www/html/buildspec.yaml

