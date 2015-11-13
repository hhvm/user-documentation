<?hh // strict

use Psr\Http\Message\ServerRequestInterface;

abstract class HTTPException extends \Exception {
  abstract public function respond(
    ServerRequestInterface $request,
  ): Awaitable<void>;
}
abstract class RoutingException extends HTTPException {}

final class HTTPNotFoundException extends RoutingException {
  public async function respond(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    header('HTTP/1.0 404 Not Found');

    await (new HTTP404Controller(ImmMap { }, $request))->respond();
  }
}

final class HTTPMethodNotAllowedException extends RoutingException {
  public async function respond(
    ServerRequestInterface $_,
  ): Awaitable<void> {
    header('HTTP/1.0 405 Method Not Allowed');
  }
}

final class RedirectException extends HTTPException {
  public function __construct(
    private string $destination,
  ) {
    parent::__construct();
  }

  public async function respond(
    ServerRequestInterface $_,
  ): Awaitable<void> {
    header('Location: '.$this->destination, true, 301);
  }
}
