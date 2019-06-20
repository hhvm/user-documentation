#!/bin/sh
set -ex
hhvm --version
export DEBIAN_FRONTEND=noninteractive
apt-get update -y
apt-get install -y ruby bundler php-cli unzip zip

curl https://getcomposer.org/installer | php -- /dev/stdin --install-dir=/usr/local/bin --filename=composer

cd /var/source
git submodule update --init
php /usr/local/bin/composer install
bundle install --path vendor-rb

hhvm bin/build.php
hh_server --check $(pwd)
vendor/bin/hacktest tests/
vendor/bin/hhast-lint
# Clean up now we're done; do it here so we don't get permission errors outside
# of docker in the deploy step
git clean -ffdx
