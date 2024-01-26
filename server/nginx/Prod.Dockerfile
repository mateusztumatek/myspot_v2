FROM node:14 as front_builder
ARG NODE_COMMAND

WORKDIR /frontend
COPY frontend .
RUN  npm install \
    && npm run $NODE_COMMAND

FROM nginx:1.25

RUN apt-get update \
    && apt-get install -y rsync \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copy Nginx conf
COPY server/nginx/nginx-conf /etc/nginx

# Copy Front (vue application)
COPY --from=front_builder --chown=www-data /front/dist /var/tmp-www/front/dist
RUN mkdir -p /var/www/front && chown www-data /var/www/front

CMD ["/bin/bash", "-c", "rsync -r /var/tmp-www/front/ /var/www/front && rm -rf /var/tmp-www && nginx -g 'daemon off;'"]
