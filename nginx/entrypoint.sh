#!/bin/bash

sed "s/php:9000/${FPM_HOST}:${FPM_PORT}/g" /etc/nginx/conf.d/default.conf

nginx -g daemon off;