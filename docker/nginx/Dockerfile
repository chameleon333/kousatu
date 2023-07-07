# docker/nginx/Dockerfile
FROM nginx:1.17.10

RUN mkdir /etc/nginx/ssl/
RUN mkdir -p /var/www/

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY nginx/ssl/server.crt /etc/nginx/ssl/server.crt
COPY nginx/ssl/server.key /etc/nginx/ssl/server.key
COPY nginx/ssl/server.password /etc/nginx/ssl/server.password

COPY ./ /var/www/
