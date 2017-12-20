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
bundle install --without=gfm --path vendor-rb

hh_server --check $(pwd)
hhvm bin/build.php
hhvm -d hhvm.php7.all=0 -d hhvm.jit=0 vendor/bin/phpunit
hhvm -d hhvm.php7.all=1 -d hhvm.jit=0 vendor/bin/phpunit

HHVM_VERSION=$(hhvm --php -r 'echo HHVM_VERSION_ID;' 2>/dev/null);
if [ $HHVM_VERSION -ge 32200 -a $HHVM_VERSION -lt 32300 ]; then
  echo enable_experimental_tc_features = optional_shape_field, unknown_fields_shape_is_not_subtype_of_known_fields_shape >> .hhconfig
  hh_server --check $(pwd)
fi
