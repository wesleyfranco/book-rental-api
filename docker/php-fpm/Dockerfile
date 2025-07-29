FROM php:8.4.2-fpm-alpine3.21

# set your UID and GID
ARG UID=1000 # Example UID, adjust to match your host users UID
ARG GID=1000 # Example GID, adjust to match your host users GID

# Install system dependencies
RUN apk add --no-cache \
    coreutils \
    gettext \
    argon2-libs \
    libedit \
    libxml2 \
    musl \
    pcre2 \
    zlib \
    make \
    curl \
    vim \
    bash \
    build-base \
    gcc \
    wget \ 
    git \
    autoconf \
    libmcrypt-dev \ 
    g++ \
    make \
    openssl-dev

# Install PHP extensions
RUN apk add --no-cache \
    php84-fpm \
    php84-ctype \
    php84-curl \
    php84-dom \
    php84-gd \
    php84-iconv \
    php84-intl \
    php84-fileinfo\
    php84-mbstring \
    php84-opcache \
    php84-openssl \
    php84-pdo \
    php84-pdo_mysql \
    php84-mysqli \
    php84-xml \
    php84-xsl \
    php84-phar \
    php84-tokenizer \
    php84-session \
    php84-simplexml \
    php84-zip \
    php84-xmlwriter \
    php84-sodium 

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin"

RUN docker-php-ext-install pdo_mysql

# Create system user to run Composer and Artisan Commands
RUN addgroup --gid ${GID} --system laravel && \
    adduser --uid ${UID} --system --disabled-password --gecos "" --ingroup laravel laravel

COPY php.ini /etc/php84/conf.d/
COPY php.ini /etc/php84/cli/conf.d/

# Set working directory
WORKDIR /var/www

USER laravel