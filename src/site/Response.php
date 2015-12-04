<?hh

use \Psr\Http\Message\ResponseInterface;

abstract final class Response {

  public static function newEmpty(): ResponseInterface {
    return new \Zend\Diactoros\Response();
  }

  public static function newWithStringBody(string $body): ResponseInterface {
    $stream = new \Zend\Diactoros\Stream('php://temp', 'wb+');
    $stream->write($body);
    return self::newEmpty()->withBody($stream);
  }
}
