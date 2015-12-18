#!/bin/bash

set -e

if [ ! -e Dockerrun.aws.json ]; then
  echo "Run from root directory of checkout"
  exit 1
fi

export REMOTE_TEST_HOST=staging.docs.hhvm.com
exec hhvm vendor/bin/phpunit --group remote
