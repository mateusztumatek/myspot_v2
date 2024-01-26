FROM node:14 as laravel_npm_builder

WORKDIR /build
COPY . .
RUN npm install && npm run prod

FROM node:16 as widget_builder
ARG NODE_COMMAND

WORKDIR /build
COPY . .
WORKDIR /build/modules/Widget
RUN npm install \
    && npm run $NODE_COMMAND

FROM serversideup/php:8.2-fpm

RUN apt-get update \
    && apt-get install -y php8.2-cli php8.2-dev \
    php8.2-pgsql php8.2-sqlite3 php8.2-gd \
    php8.2-curl \
    php8.2-imap php8.2-mysql php8.2-mbstring \
    php8.2-xml php8.2-zip php8.2-bcmath php8.2-soap \
    php8.2-intl php8.2-readline \
    php8.2-ldap \
    php8.2-msgpack php8.2-igbinary php8.2-redis php8.2-swoole \
    php8.2-memcached php8.2-pcov \
    php8.2-dom php8.2-xsl php8.2-calendar \
    git \
    rsync \
    mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer/composer:2-bin /composer /usr/bin/composer
# allow access to composer cache when running as webuser
RUN mkdir /composer && chown webuser /composer
# resolve problems with installs from git repositories
RUN git config --global --add safe.directory '*'
RUN mkdir -p /var/www/backend && chown webuser /var/www/backend
WORKDIR /var/www/backend
COPY --chown=webuser . .

USER webuser

# @TODO: We should run with flag --no-dev, but there are some problems when we run pipelines without dev dependencies (Scribe docs generating).
RUN composer install --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist --optimize-autoloader
USER root

# custom startup script
COPY docker/laravel-automations/laravel-automations /etc/s6-overlay/scripts/laravel-automations

COPY --chown=webuser public /var/tmp-www/public/
COPY --chown=webuser --from=laravel_npm_builder /build/public /var/tmp-www/public/
COPY --chown=webuser --from=widget_builder /build/public /var/tmp-www/public/

RUN ln -s envs/.env .env
