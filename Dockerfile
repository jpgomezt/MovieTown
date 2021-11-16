FROM php:7.4-apache

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/htm
COPY ./public/.htaccess /var/www/html/.htaccess
WORKDIR /var/www/html
RUN chmod -R 777 MovieTown
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

RUN php artisan key:generate
RUN php artisan migrate:fresh
RUN php artisan db:seed
RUN php artisan storage:link
RUN chmod -R 777 storage
RUN a2enmod rewrite
RUN service apache2 restart
