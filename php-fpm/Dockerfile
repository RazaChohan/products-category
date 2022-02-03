FROM alpine:3.15

LABEL maintainer="Muhammad Raza <razachohan@gmail.com>"

RUN apk add --no-cache \
    coreutils \
    gettext \
    php8-fpm \
    php8-ctype \
    php8-curl \
    php8-dom \
    php8-gd \
    php8-iconv \
    php8-json \
    php8-intl \
    php8-fileinfo\
    php8-mbstring \
    php8-opcache \
    php8-openssl \
    php8-pdo \
    php8-pdo_mysql \
    php8-mysqli \
    php8-xml \
    php8-xsl \
    php8-zlib \
    php8-phar \
    php8-tokenizer \
    php8-session \
    php8-simplexml \
    php8-zip \
    php8-xmlwriter \
    php8-sodium \
    php8-pecl-apcu \
    make \
    curl

RUN curl -sS https://getcomposer.org/installer | tee composer-setup.php \
    && php8 composer-setup.php && rm composer-setup.php* \
    && chmod +x composer.phar && mv composer.phar /usr/bin/composer \
    && ln -s /usr/bin/php8 /usr/local/bin/php

#RUN wget https://github.com/symfony/cli/releases/download/v$SYMFONY_CLI_VERSION/symfony_linux_amd64.gz \
#    && gzip -d symfony_linux_amd64.gz \
#    && mv symfony_linux_amd64 symfony \
#    && chmod +x symfony \
#    && mv symfony /usr/local/bin/

COPY application.ini /etc/php8/conf.d/
COPY application.ini /etc/php8/cli/conf.d/

COPY application.pool.conf /etc/php8/php-fpm.d/

WORKDIR /var/www/application

CMD ["php-fpm8", "-F"]

EXPOSE 9001