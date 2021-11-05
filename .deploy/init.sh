#!/bin/bash

set -ex

if ! [ -e /.docker_build ]; then
  echo "This script should only be ran from a Dockerfile"
  exit 1
fi

if ! [ -x .deploy/system-init.sh ]; then
  echo "Run from the root directory of the source tree."
  exit 1
fi

.deploy/system-init.sh

echo "** Installing Hack dependencies"
composer install

echo "** Run build"
hhvm bin/build.php --auto
