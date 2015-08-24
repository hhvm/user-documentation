<?hh

require_once(__DIR__.'/../vendor/autoload.php');

$path = __DIR__.'/../build/merged/function.HH.autoload_set_paths.yml';
echo (new HHVM\UserDocumentation\FunctionMarkdownBuilder($path))->build();
