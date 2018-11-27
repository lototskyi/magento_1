FROM phpdockerio/php71-fpm:latest
WORKDIR "/application"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.1-mysql \
    && apt-get -y install php7.1-gd \
    && apt-get -y install libmcrypt-dev \
    && apt-get -y install php7.1-intl \
    && apt-get -y install php-soap \
    && apt-get -y install php-bcmath \
    && apt-get -y install php7.1-mcrypt \
    && apt-get -y install php7.1-soap \
    && apt-get -y install php7.1-bcmath \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*