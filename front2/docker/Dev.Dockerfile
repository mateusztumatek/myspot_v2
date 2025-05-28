FROM node:20
WORKDIR /var/www/html

# Install PHP Imagemagick using regular Ubuntu commands
RUN apt-get update \
    && apt-get install -y g++ build-essential \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && npm install -g @ionic/cli


COPY docker/.bashrc /root/.bashrc
COPY docker/.profile /root/.profile
ENV ENV=/root/.profile
RUN ln -sf /usr/bin/bash /usr/bin/sh


