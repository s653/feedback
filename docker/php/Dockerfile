FROM php:8.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install PHP and composer dependencies
RUN apt-get update && apt-get install -y \
    git \
    bash \
    vim \
    nano \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    sqlite3 \
    zip \
    unzip \
    build-essential \
    locales \
    jpegoptim optipng pngquant gifsicle \
    software-properties-common

RUN pecl install xdebug

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd bcmath opcache
RUN docker-php-ext-install pdo_mysql

RUN apt-get update

# Install composer and nodejs
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y nodejs python3-pip
RUN apt-get update
RUN apt-get install -y mysql\*


RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user


RUN mkdir -p /var/www/html/feedback/backend

# Permissions
RUN chown -R www-data:www-data /var/www/html/feedback/backend


# Change current user
USER $user

CMD ["php-fpm"]