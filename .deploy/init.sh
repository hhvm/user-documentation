#!/bin/bash

set -ex

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

echo "** Installing apt dependencies"
# This is done by the dockerfile, but the intermediate issue can be cached, so do
# it again here.
apt-get clean
apt-get update -y

apt-get install -y ruby php-cli zip unzip locales

echo "** Updating locales"
locale-gen en_US.UTF-8

echo "** Installing composer"
mkdir /opt/composer
wget -qO /dev/stdout https://getcomposer.org/installer | php -- --install-dir=/opt/composer
if [ ! -e /opt/composer/composer.phar ]; then
  echo "Failed to install composer"
  exit 1
fi

echo "** Installing Hack dependencies"
php /opt/composer/composer.phar install

echo "** Run build"
hhvm bin/build.php --auto
