FROM ubuntu:16.04

RUN apt-get clean && apt-get -y update && apt-get install -y locales curl software-properties-common git \
  && locale-gen en_US.UTF-8
RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php \
&& apt-get update \
&& apt-get install -y --force-yes \
libgmp-dev \
php7.2-gmp \
php7.2-bz2 \
php7.2-cli \
php7.2-common \
php7.2-curl \
php7.2-cgi \
php7.2-dev \
php7.2-fpm \
php7.2-gd \
php7.2-json \
php7.2-mbstring \
php7.2-mysql \
php7.2-xml \
php7.2-xmlrpc \
php7.2-xsl \
php7.2-zip  \
php7.2-xdebug  \
php-amqp \
bash-completion \
supervisor

RUN curl https://getcomposer.org/installer > composer-setup.php && php composer-setup.php && mv composer.phar /usr/local/bin/composer && rm composer-setup.php

RUN composer -vvv global require  hirak/prestissimo
RUN composer -vvv global require stecman/composer-bash-completion-plugin dev-master

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN sed -i 's/^\(\[supervisord\]\)$/\1\nnodaemon=true/' /etc/supervisor/supervisord.conf

RUN usermod -u 1000 www-data
ENV TERM xterm

ADD .docker/php/entrypoint.sh /entrypoint.sh
ADD .docker/php/.bashrc /root/.bashrc
RUN chmod 755 /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
