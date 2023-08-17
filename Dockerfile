FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
    openssl \
    git \
    curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN docker-php-ext-install ctype iconv

# Install symfony-cli to use its webserver
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv ~/.symfony5/bin/symfony /usr/local/bin

COPY . /srv/php-calculator
WORKDIR /srv/php-calculator

RUN composer install

# set permission for cache dir/files
RUN mkdir -p var/cache/prod var/log \
   && chown -R www-data:www-data var/ \
   && chmod -R ug+rwX var/

CMD symfony server:start
EXPOSE 8000
