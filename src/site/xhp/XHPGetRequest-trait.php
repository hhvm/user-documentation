<?hh // strict

use Psr\Http\Message\ServerRequestInterface;

trait XHPGetRequest {
  require extends :x:element;

  protected function getRequest(): ServerRequestInterface {
    $x = $this->getContext('ServerRequestInterface');
    invariant(
      $x instanceof ServerRequestInterface,
      '%s is not a ServerRequestInterface',
      gettype($x).' ('.get_class($x).')',
    );
    return $x;
  }
}
