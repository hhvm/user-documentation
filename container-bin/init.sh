#!/bin/bash

set -ex

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

# This is done by the dockerfile, but the intermediate issue can be cached, so do
# it again here.
apt-get clean
apt-get update -y

APT_DEPS="ruby php-cli zip unzip"
apt-get install -y $APT_DEPS

mkdir /opt/composer
wget -qO /dev/stdout https://getcomposer.org/installer | php -- --install-dir=/opt/composer
if [ ! -e /opt/composer/composer.phar ]; then
  echo "Failed to install composer"
  exit 1
fi
touch /opt/composer/.hhconfig

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
php /opt/composer/composer.phar install

echo "** Run build"
hhvm bin/build.php

echo "** Typecheck"
hh_client

# Run tests
echo "** Run tests"
vendor/bin/hacktest tests/

# Clean up
echo "** Removing build-only PHP dependencies"
php /opt/composer/composer.phar \
  install \
  --no-dev
rm -rf vendor-rb/
echo "** Removing intermediate build products"
rm -rf build/scratch
echo "** Cleaning up..."
pkill hh_server || true
rm -rf /root/.composer
rm -rf /var/www/{.git,api-sources,api-examples} /tmp/hh_server
find /var/www/guides -type f -name '*.php' -o -name '*.php.*' -o -name '*.md' \
  | xargs rm
apt-get remove -y $APT_DEPS
SUDO_FORCE_REMOVE=yes apt-get autoremove -y
apt-get clean
rm -rf /var/lib/apt/lists/*

# Debug output
hhvm --version
