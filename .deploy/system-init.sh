#!/bin/bash

set -ex

if ! [ -e /.docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

STAMP_FILE=/.hack_docs_system_init.stamp
if [ -e "$STAMP_FILE" ]; then
  exit
fi

export DEBIAN_FRONTEND=noninteractive

echo "** Installing apt dependencies"
# This is done by the dockerfile, but the intermediate issue can be cached, so do
# it again here.
apt-get clean
apt-get update -y

# Some environments (e.g. VSCode containers) will copy the exterior locale
# settings, which can break things if the current locale isn't usable in the
# container; using the `C` locale makes sure that the `locales` package
# post-install succeeds.
LC_ALL=C apt-get install -y ruby php-cli zip unzip locales

echo "** Updating locales"
locale-gen en_US.UTF-8

echo "** Installing composer"
wget -qO /dev/stdout https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
if [ ! -x /usr/local/bin/composer ]; then
  echo "Failed to install composer"
  exit 1
fi

touch "$STAMP_FILE"
