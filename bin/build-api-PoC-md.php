<?hh

require_once(__DIR__.'/../vendor/autoload.php');

$path = __DIR__.'/../build/merged/function.HH.Asio.curl_exec.yml';
echo (new HHVM\UserDocumentation\FunctionMarkdownBuilder($path))->build();
