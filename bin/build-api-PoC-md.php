<?hh

require_once(__DIR__.'/../vendor/autoload.php');

$path = __DIR__.'/../build/merged/interface.HH.KeyedIterable.yml';
echo (new HHVM\UserDocumentation\ClassMarkdownBuilder($path))->build();
