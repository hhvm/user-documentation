FROM hhvm/hhvm-proxygen:3.11.0
ENV TZ UTC

# We need a unicode-aware system to generate the docs
RUN locale-gen en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update -y

# Install Ruby and Bundler (Ruby package manager)
RUN apt-get install -y ruby1.9.3 bundler
# we depend on a recent version of the Nokogiri gem, which bundler will install
# for us later; this needs to build it's own libxml so we need to install the
# -dev versions of some dependencies
RUN apt-get install -y build-essential zlib1g-dev

# The highlighting gem installs its' own version of pygments so we don't actually
# use this, but this is a handy way to make sure all the dependencies are
# installed.
RUN apt-get install -y python-pygments

# Install Composer (PHP dependency manager)
RUN apt-get install -y curl
RUN mkdir /opt/composer
RUN curl -sS https://getcomposer.org/installer | hhvm --php -- --install-dir=/opt/composer

# We need an HHVM checkout to generate the API docs
RUN apt-get install -y git

# Copy the app into the container
RUN rm -rf /var/www
ADD . /var/www
RUN cd /var/www && git clean -fdx

# Configure
ADD hhvm.prod.ini /etc/hhvm/site.ini
RUN cd /var/www && sed 's,/home/fred/hhvm,/var/hhvm,' LocalConfig.php.example > LocalConfig.php

# Install direct dependencies
RUN cd /var/www && bundle --path vendor-rb/
RUN cd /var/www && hhvm /opt/composer/composer.phar install --optimize-autoloader

# Build (all in one so that we don't end up with +/var/hhvm and -/var/hhvm images)
RUN cd /var && git clone --depth=1 https://github.com/facebook/hhvm.git && cd /var/www && hhvm bin/build.php && hhvm vendor/bin/phpunit tests/ && rm -rf /var/hhvm

# Make the webserver port accessible outside the container
EXPOSE 80
