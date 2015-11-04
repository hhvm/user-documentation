FROM fredemmott/hhvm-proxygen:3.10.1
RUN apt-get update -y

# We need a unicode-aware system to generate the docs
RUN locale-gen en_US.UTF-8
ENV LANG en_us.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

# Install Ruby and Bundler (Ruby package manager)
RUN apt-get install -y ruby1.9.3 bundler rubygems
# we depend on a recent version of the Nokogiri gem, which bundler will install
# for us later; this needs to build it's own libxml so we need to install the
# -dev versions of some dependencies
RUN apt-get install -y build-essential zlib1g-dev

# The highlighting gem installs its' own version of pygments so we don't actually
# use this, but this is a handy way to make sure all the dependencies are
# installed.
RUN apt-get install -y python-pygments

# Install Sass dependencies
RUN gem install sass bourbon

# Install Composer (PHP dependency manager)
RUN apt-get install -y curl
RUN mkdir /opt/composer
RUN curl -sS https://getcomposer.org/installer | hhvm --php -- --install-dir=/opt/composer

# We need an HHVM checkout to generate the API docs
RUN apt-get install -y git
RUN cd /var && git clone --depth=1 --branch HHVM-3.10 https://github.com/facebook/hhvm.git

# Copy the app into the container
RUN rm -rf /var/www
ADD . /var/www

# Configure
ADD hhvm.prod.ini /etc/hhvm/site.ini
RUN cd /var/www && sed 's,/home/fred/hhvm,/var/hhvm,' LocalConfig.php.example > LocalConfig.php

# Install direct dependencies
RUN cd /var/www/md-render && bundle --path vendor/
RUN cd /var/www && hhvm /opt/composer/composer.phar install
RUN bourbon install --path /var/www/scss/

# Build
RUN cd /var/www && hhvm bin/build.php
RUN sass /var/www/scss/main.scss:/var/www/public/main.css --style compressed

# Make the webserver port accessible outside the container
EXPOSE 80
