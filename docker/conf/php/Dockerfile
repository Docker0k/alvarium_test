FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
	curl \
	wget \
	unzip \
	libfreetype6-dev \
	libjpeg62-turbo-dev \
	libpng-dev \
	libxslt-dev \
	libicu-dev \
	libmcrypt-dev \
	libxml2-dev \
	libzip-dev \
	libonig-dev \
	libpq-dev \
    libmagickwand-dev \
	poppler-utils \
	nodejs \
	npm

RUN docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip calendar
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl xsl soap exif

RUN pecl install imagick
RUN docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD ./docker/conf/php/php.ini /usr/local/etc/php/php.ini

RUN pecl install xdebug redis
RUN docker-php-ext-enable redis xdebug \
&& echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.log_level = 0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.discover_client_host = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.idekey = \"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
