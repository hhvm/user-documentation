<?hh

require_once(__DIR__.'/../vendor/autoload.php');

$request = \Zend\Diactoros\ServerRequestFactory::fromGlobals();

HH\Asio\join(
  (new HHVMDocumentationSite())->respondTo($request)
);
