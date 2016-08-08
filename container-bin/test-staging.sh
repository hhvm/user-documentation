#!/bin/bash

set -e

if [ ! -e /docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

cd /var/www
# init.sh removes dev dependencies like phpunit as they are not required
# to run the site, but we need them here.
hhvm /opt/composer/composer.phar install
exec bin/test-staging.sh
