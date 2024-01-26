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
    mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer/composer:2-bin /composer /usr/bin/composer
RUN mkdir /composer && chown webuser /composer
RUN git config --global --add safe.directory '*'

RUN mkdir -p /var/www/backend && chown webuser /var/www/backend
WORKDIR /var/www/backend
COPY --chown=webuser . .
COPY --chown=webuser .env.ci .env
USER webuser
RUN composer install --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

ENTRYPOINT []

CMD ["./run-tests.sh"]


