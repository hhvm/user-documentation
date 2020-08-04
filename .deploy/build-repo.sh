#!/bin/sh
set -e

echo "** Uninstalling dev-dependencies"
php /opt/composer/composer.phar install --no-dev --no-autoloader

echo "** Regenerating autoload map"
hhvm \
  -d hhvm.hack.lang.enable_xhp_class_modifier=true \
  -d hhvm.hack.lang.disable_xhp_element_mangling=true \
  vendor/bin/hh-autoload

echo "** Marking revision"
git rev-parse HEAD > DOCSITE_REV

echo "** Building repository"
set -x
hhvm --hphp --target hhbc \
  -l3 \
  -d hhvm.check_return_type_hints=3 \
  -d hhvm.hack.lang.enable_xhp_class_modifier=true \
  -d hhvm.hack.lang.disable_xhp_element_mangling=true \
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
