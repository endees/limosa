FROM php:8.1-apache

ARG USER
ARG UID
ARG XDEBUG_VERSION=3.0.1
ARG DEPLOYMENT_MODE

RUN apt-get update && apt-get install -y \
        zip \
        unzip \
        curl \
        git \
        mariadb-client \
        libfreetype6-dev \
        libjpeg62-turbo-dev  \
        libxml2-dev  \
        npm \
    && docker-php-ext-install -j$(nproc) iconv mysqli pdo_mysql soap \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-configure soap \
    && docker-php-ext-install -j$(nproc) gd
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

ADD ./dockerfiles/laravel.ini /usr/local/etc/php/conf.d
ADD ./dockerfiles/000-default.conf /etc/apache2/sites-enabled

ADD ./dockerfiles/xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

RUN \ | if [ "$DEPLOYMENT_MODE" = "dev" ] ; then \
        mkdir -p /usr/src/php/ext/xdebug ; \
        curl -fsSL https://xdebug.org/files/xdebug-${XDEBUG_VERSION}.tgz | tar xz -C /usr/src/php/ext/xdebug --strip 1 ; \
        docker-php-ext-install xdebug ; \
        fi
RUN a2enmod rewrite
RUN a2enmod ssl

RUN useradd -l -u ${UID:-1000} -m -g 33 $USER

RUN echo 'root:Docker!' | chpasswd
USER ${USER}:www-data