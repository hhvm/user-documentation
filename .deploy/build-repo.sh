#!/bin/sh
set -e

echo "** Uninstalling dev-dependencies"
composer install --no-dev

echo "** Marking revision"
git rev-parse HEAD > DOCSITE_REV

echo "** Building repository"
set -x
hhvm --hphp --target hhbc \
  -l3 \
  -d hhvm.check_return_type_hints=3 \
  --module src \
  --module vendor \
  --module build/final \
  --ffile public/index.php \
  --cfile DOCSITE_REV \
  --cmodule public \
  --cmodule build/final \
  $(find guides -type f -name '*.txt' | sed 's,^,--cfile ,') \
  --output-dir /var/out \
  --file-cache /var/out/file.cache
set +x

echo "** Listing outputs"
ls -lh /var/out
