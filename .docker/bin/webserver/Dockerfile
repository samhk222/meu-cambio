FROM php:7.2-apache

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

RUN apt-get -y install apt-utils iputils-ping nano wget dialog \
    build-essential git curl libcurl3 libcurl3-dev zip supervisor \
    libmcrypt-dev libsqlite3-dev libsqlite3-0 mysql-client openssl cron \
    zlib1g-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install mcrypt-1.0.1

# Install redis
RUN pecl install redis-4.0.1

# PHP5 Extensions
RUN docker-php-ext-install curl \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install json \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-enable redis \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Para conseguir ler as variáveis de ambiente no php-cli
RUN echo 'alias ll="ls -lah"' >> ~/.bashrc

RUN composer global require laravel/installer
#RUN export PATH=$PATH:$ADDITIONAL_PATH;

ENV AMBIENTE DEV
ENV DB_HOST NEWSREADER-5.6-mysql
ENV DB_DATABASE newsreader
ENV DB_USERNAME root
ENV DB_PASSWORD FB_e3W)>-)gH(/5m
ENV ENV_FROM Dockerfile
ENV DOCKER_WEB_PORT 8877
ENV LARAVEL_PATH ~/.composer/vendor/bin

#Enable apache modules
RUN a2enmod rewrite headers proxy proxy_http

RUN echo "*/10 * * * * /usr/local/bin/php -f /var/www/html/artisan route:call /refresh-feed >> /var/www/html/index.html" | crontab -

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf