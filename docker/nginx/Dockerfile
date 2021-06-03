# docker/nginx/Dockerfile
FROM nginx:1.17.10

ADD ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/
ADD ./ /var/www/
