#!/bin/bash

set -e

if [ ! -e composer.json ]; then
  echo "Run from root directory of checkout"
  exit 1
fi

export REMOTE_TEST_HOST=staging.docs.hhvm.com
exec vendor/bin/hacktest --filter-groups=remote tests/
