#+++++++++++++++++++++++++++++++++++++++
# Dockerfile for webdevops/php-nginx:8.3-alpine
#    -- automatically generated  --
#+++++++++++++++++++++++++++++++++++++++

FROM webdevops/php:8.3-alpine

ENV WEB_DOCUMENT_ROOT=/var/www/html/public \
    WEB_DOCUMENT_INDEX=index.php \
    WEB_ALIAS_DOMAIN=*.vm \
    WEB_PHP_TIMEOUT=600 \
    WEB_PHP_SOCKET=""
ENV WEB_PHP_SOCKET=127.0.0.1:9000
ENV SERVICE_NGINX_CLIENT_MAX_BODY_SIZE="50m"

COPY conf/ /opt/docker/

COPY . /var/www/html

RUN chmod 777 /var/www/html -R

RUN composer install --no-dev --working-dir=/var/www/html

RUN set -x \
    # Install nginx
    && apk-install \
        nginx \
    && docker-run-bootstrap

EXPOSE 80
