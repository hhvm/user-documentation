#!/bin/bash

set -ex

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

# Install Ruby and Bundler (Ruby package manager)
apt-get install -y ruby bundler
# we depend on a recent version of the Nokogiri gem, which bundler will install
# for us later; this needs to build it's own libxml so we need to install the
# -dev versions of some dependencies
apt-get install -y build-essential zlib1g-dev

# The highlighting gem installs its' own version of pygments so we don't actually
# use this, but this is a handy way to make sure all the dependencies are
# installed.
apt-get install -y python-pygments

mkdir /opt/composer
wget -qO /dev/stdout https://getcomposer.org/installer | hhvm --php -- --install-dir=/opt/composer
if [ ! -e /opt/composer/composer.phar ]; then
  echo "Failed to install composer"
  exit 1
fi
touch /opt/composer/.hhconfig

# We need the HHVM source to build the docs
(cd /var && git clone --depth=1 https://github.com/facebook/hhvm.git)

# No point running anything else for devservers, as /var/www gets mounted
# over anyway
if [ "${DOCKER_BUILD_ENV}" == "dev" ]; then
  apt-get clean
  rm -rf /var/lib/apt/lists/*
  exit
fi

# Configure
cp hhvm.${DOCKER_BUILD_ENV}.ini /etc/hhvm/site.ini

# Install direct dependencies
touch /opt/composer/.hhconfig
hhvm /opt/composer/composer.phar install
hh_server --check $(pwd) # fail early
bundle --path vendor-rb/

echo "** Run build"
hhvm bin/build.php

# Run tests
echo "** Run tests"
hhvm vendor/bin/phpunit tests/

# Clean up
echo "** Removing build-only PHP dependencies"
hhvm /opt/composer/composer.phar \
  install \
  --no-dev \
  --optimize-autoloader
rm -rf vendor-rb/
echo "** Removing intermediate build products"
rm -rf build/*-yaml/ build/*-markdown/
echo "** Cleaning up..."
rm -rf /root/.composer
rm -rf /var/hhvm /var/www/.git /tmp/hh_server
apt-get remove -y \
  build-essential ruby bundler zlib1g-dev python-pygments curl
SUDO_FORCE_REMOVE=yes apt-get autoremove -y
apt-get clean
rm -rf /var/lib/apt/lists/*

# Debug output
hhvm --version
