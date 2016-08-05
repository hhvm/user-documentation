#!/bin/bash

set -e

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

cd /var/www
# init.sh does not install dev dependencies like phpunit
hhvm /opt/composer/composer.phar install
exec bin/test-staging.sh
