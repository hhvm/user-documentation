#/bin/bash

set -e

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Docker container"
  exit 1
fi

cd /var/www
hhvm /opt/composer/composer.phar install
bundle --path vendor-rb
sed 's,/home/fred/hhvm,/var/hhvm,' LocalConfig.php.example \
  > LocalConfig.php

hhvm bin/build.php
