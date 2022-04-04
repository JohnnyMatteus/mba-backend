FROM php:7.3-fpm

LABEL maintainer = "Johnny Santos <fjmatteus20@gmail.com>"

ENV EXT_AMQP_VERSION=master

ARG UID

RUN adduser --disabled-password --gecos '' appuser

RUN mkdir /home/appuser/.ssh
RUN chown -R appuser:appuser /home/appuser/

RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config
RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
RUN echo "alias sf=/var/www/html/bin/console" >> /home/appuser/.bashrc

RUN wget https://get.symfony.com/cli/installer -O - | bash


# Additional tools
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libzip-dev \
    libonig-dev \
    libmcrypt-dev \
    libpng-dev \
    tzdata \
    wget \
    zip \
    git \
    vim \
    python \
    librabbitmq-dev

# Common php-ext and requirements
RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev libz-dev \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install session \
    && docker-php-ext-install phar \
    && docker-php-ext-install iconv \
    && docker-php-ext-install pdo

#####################################
# SET TIMEZONE:
#####################################

ARG TIMEZONE
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE}/etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

#####################################
# GD:
#####################################

ARG INSTALL_GD=false
RUN if [ ${INSTALL_GD} = true ]; then \
    # Install gd and requirements
    apt-get update && apt-get install -y --no-install-recommends libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-install gd \
    ;fi

#####################################
# compression:
#####################################

ARG INSTALL_COMPRESSION=false
RUN if [ ${INSTALL_COMPRESSION} = true ]; then \
    # Install zip, bz2 and requirements
    apt-get update && apt-get install -y --no-install-recommends libbz2-dev zlib1g-dev \
    && docker-php-ext-install zip \
    bz2 \
    ;fi

#####################################
# FTP:
#####################################

ARG INSTALL_FTP=false
RUN if [ ${INSTALL_FTP} = true ]; then \
    # Install ftp and requirements
    apt-get update && apt-get install -y --no-install-recommends libssl-dev \
    && docker-php-ext-install ftp \
    ;fi

#####################################
# Mbstring:
#####################################

ARG INSTALL_MBSTRING=false
RUN if [ ${INSTALL_MBSTRING} = true ]; then \
    # Install mbstring
    docker-php-ext-install mbstring \
    ;fi

#####################################
# PDO_MYSQL:
#####################################

ARG INSTALL_PDO_MYSQL=false
RUN if [ ${INSTALL_PDO_MYSQL} = true ]; then \
    # Install pdo_mysql
    docker-php-ext-install pdo_mysql \
    ;fi

#####################################
# Mysqli Modifications:
#####################################

ARG INSTALL_MYSQLI=false
RUN if [ ${INSTALL_MYSQLI} = true ]; then \
    # Install mysqli
    docker-php-ext-install mysqli \
    ;fi

#####################################
# bcmath:
#####################################

ARG INSTALL_BCMATH=false
RUN if [ ${INSTALL_BCMATH} = true ]; then \
    # Install bcmath extension
    docker-php-ext-install bcmath \
    ;fi

#####################################
# Redis:
#####################################

ARG INSTALL_REDIS=false
RUN if [ ${INSTALL_REDIS} = true ]; then \
    pecl install redis && \
    docker-php-ext-enable redis \
    ;fi

#####################################
# APCu:
#####################################

ARG INSTALL_APCU=false
RUN if [ ${INSTALL_APCU} = true ]; then \
    pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl clear-cache \
    ;fi

#####################################
# Opcache:
#####################################

ARG INSTALL_OPCACHE=false
RUN if [ ${INSTALL_OPCACHE} = true ]; then \
    docker-php-ext-install opcache \
    ;fi

# Copy opcache configration
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

#####################################
# xdebug:
#####################################

ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    # Install the xdebug
    #pecl install xdebug \
    pecl install xdebug-3.0.0 \
    && docker-php-ext-enable xdebug \
    ;fi

# Copy xdebug configration
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#####################################
# composer:
#####################################

ARG INSTALL_COMPOSER=false
RUN if [ ${INSTALL_COMPOSER} = true ]; then \
    # Install the composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    composer self-update --1 \
    ;fi

#####################################
# tokenizer:
#####################################

ARG INSTALL_TOKENIZER=false
RUN if [ ${INSTALL_TOKENIZER} = true ]; then \
    # Install tokenizer
    docker-php-ext-install tokenizer \
    ;fi

#####################################
# json, xml, dom xmlrpc, xsl:
#####################################

RUN apt-get update \
    && apt-get install -y libxml2-dev \
    && docker-php-ext-install xml

RUN docker-php-ext-install soap

#####################################
# Human Language and Character Encoding Support:
#####################################

ARG INSTALL_INTL=false
RUN if [ ${INSTALL_INTL} = true ]; then \
    # Install intl and requirements
    apt-get update && apt-get install -y --no-install-recommends zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    ;fi

# Clear package lists
RUN rm -rf /var/lib/apt/lists/*

ARG INSTALL_AMQP=false
RUN if [ ${INSTALL_AMQP} = true ]; then \
    # install AMQP
    docker-php-source extract \
    && git clone --branch $EXT_AMQP_VERSION --depth 1 https://github.com/php-amqp/php-amqp.git /usr/src/php/ext/amqp \
    && cd /usr/src/php/ext/amqp && git submodule update --init \
    && docker-php-ext-install amqp \
    ;fi

COPY ./cacert.pem /usr/local/etc/php/cacert.pem
COPY ./cacert.pem /etc/ssl/certs/cacert.pem
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN update-ca-certificates

# Install supervisor
RUN apt-get update && apt-get install -y supervisor

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy nginx/php/supervisor configs
COPY ./supervisor.conf /etc/supervisord.conf

# Permissions
RUN chown -R appuser:appuser /var/www/html
RUN chmod u+rwx,g+rx,o+rx /var/www/html

RUN find /var/www/html -type d -exec chmod u+rwx,g+rx,o+rx {} +
RUN find /var/www/html -type f -exec chmod u+rw,g+rw,o+r {} +

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

USER appuser

EXPOSE 9000
