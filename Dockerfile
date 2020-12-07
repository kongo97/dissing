FROM php:7.3-apache

RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y zip unzip vim libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Install xdebug from pecl
RUN apt -qy install $PHPIZE_DEPS && pecl install xdebug-2.7.2 && docker-php-ext-enable xdebug
# Configure xdebug 
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install nodejs
RUN curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh && bash nodesource_setup.sh && apt-get -y --force-yes install nodejs

# Upgrading Node
RUN npm cache clean -f
#RUN npm install -g n
#RUN n stable

#RUN cd /var/www/html && npm install

# Set working directory
WORKDIR /var/www/html

USER $user