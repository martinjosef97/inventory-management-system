FROM php:8.1.22-apache-bookworm

WORKDIR /var/www/html

COPY ../../assets ./assets/
COPY ../../*.php .
COPY ../../composer.* .
COPY ../../data ./data/
COPY ../../inc ./inc/
COPY ../../model ./model/
COPY ../../vendor ./vendor/

RUN apt update && docker-php-ext-install pdo pdo_mysql

CMD ["php", "./login.php"]