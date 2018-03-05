#!/bin/sh
set -ex
hhvm --version
export DEBIAN_FRONTEND=noninteractive
apt-get update -y
apt-get install -y ruby bundler

curl https://getcomposer.org/installer | hhvm -d hhvm.jit=0 --php -- /dev/stdin --install-dir=/usr/local/bin --filename=composer

cd /var/source
git submodule update --init
hhvm -d hhvm.jit=0 /usr/local/bin/composer install
bundle install --path vendor-rb

hh_client
hhvm bin/build.php
hhvm -d hhvm.php7.all=0 -d hhvm.jit=0 vendor/bin/phpunit
hhvm -d hhvm.php7.all=1 -d hhvm.jit=0 vendor/bin/phpunit

grep ignored_paths .hhconfig > hhconfig
mv hhconfig .hhconfig
hh_server --check $(pwd)
