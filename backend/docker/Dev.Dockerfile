FROM serversideup/php:8.2-fpm

ARG PUID \
    PGID

RUN apt-get update \
    && apt-get install -y php8.2-cli php8.2-dev \
    php8.2-pgsql php8.2-sqlite3 php8.2-gd \
    php8.2-curl \
    php8.2-imap php8.2-mysql php8.2-mbstring \
    php8.2-xml php8.2-zip php8.2-bcmath php8.2-soap \
    php8.2-intl php8.2-readline \
    php8.2-ldap \
    php8.2-msgpack php8.2-igbinary php8.2-redis \
    php8.2-memcached php8.2-pcov  \
    # enable if you want enable xdebug and profiler
    # php8.2-xdebug \
    php8.2-dom php8.2-xsl php8.2-calendar \
    git \
    mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer/composer:2-bin /composer /usr/bin/composer
RUN mkdir /composer && chown ${PUID}:${PGID} /composer

RUN mkdir -p /var/www/backend && chown ${PUID}:${PGID} /var/www/backend
WORKDIR /var/www/backend

COPY docker/laravel-automations/laravel-automations /etc/s6-overlay/scripts/laravel-automations
COPY docker/.bashrc /root/.bashrc
COPY docker/.profile /root/.profile
ENV ENV=/root/.profile

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash \
    && bash -c "source ~/.nvm/nvm.sh --no-use && nvm install 14 && nvm install 16"

RUN ln -sf /usr/bin/bash /usr/bin/sh

# enable if you want enable xdebug and profiler
# COPY docker/phpiniconfig/xdebug.ini /etc/php/8.2/mods-available/xdebug.ini
