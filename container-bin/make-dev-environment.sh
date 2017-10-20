#/bin/bash

set -e

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Docker container"
  exit 1
fi

cd /var/www
hhvm /opt/composer/composer.phar install
bundle --path vendor-rb

hhvm bin/build.php
