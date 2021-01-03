FROM php:7.4-apache

ARG INSTALL_DIRECTORY=/var/www/rockar
ARG DOMAIN=rockar

RUN apt-get update \
    && apt-get install -y git unzip htop libcurl3-dev zlib1g-dev libicu-dev g++ libldb-dev libldap2-dev libreadline-gplv2-dev libedit-dev libedit2 wget\
    && ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so \
    && ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install intl
# RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install curl
# RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN pecl install pcov && docker-php-ext-enable pcov

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/container/app/vhosts/${DOMAIN}.conf /etc/apache2/sites-available/${DOMAIN}.conf
RUN a2enmod rewrite
RUN a2dissite 000-default.conf
RUN a2ensite ${DOMAIN}.conf

ENV TZ=Europe/London
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN mkdir /app
COPY . /app
RUN ln -s /app ${INSTALL_DIRECTORY}
WORKDIR /app

RUN composer install

COPY ./docker/container/app/scripts/entrypoint.sh  /entrypoint.sh
COPY ./docker/container/app/scripts/waitforit.sh /waitfor

RUN chmod +x /entrypoint.sh
RUN chmod +x /waitfor

CMD ["/entrypoint.sh"]
