FROM alpine

RUN apk add php php-curl curl bash openjdk11 chromium php-phar php-openssl php-iconv php-mbstring

WORKDIR "/var/www/html/limosa"

RUN curl -sS https://getcomposer.org/installer | php

ADD . .
RUN php composer.phar install

RUN java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-4.13.0.jar standalone &
