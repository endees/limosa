FROM alpine

RUN apk add php php-curl curl bash openjdk11 chromium php-phar php-openssl php-iconv php-mbstring zip

WORKDIR "/var/www/html/limosa"

RUN curl -sS https://getcomposer.org/installer | php

ADD . .
RUN php composer.phar install

CMD bash
