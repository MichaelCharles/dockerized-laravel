FROM nginx:latest
RUN apt-get update -y && apt-get install dos2unix -y

COPY ./default.conf /etc/nginx/conf.d/default.conf

COPY entrypoint.sh /usr/local/bin/
RUN dos2unix /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
