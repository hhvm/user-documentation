<?hh // strict

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class HTTPException extends \Exception {
  abstract public function getResponse(
    ServerRequestInterface $request,
  ): Awaitable<ResponseInterface>;
}
abstract class RoutingException extends HTTPException {}

final class HTTPNotFoundException extends RoutingException {
  public async function getResponse(
    ServerRequestInterface $request,
  ): Awaitable<ResponseInterface> {
    return await (new HTTP404Controller(ImmMap { }, $request))->getResponse();
  }
}

final class HTTPMethodNotAllowedException extends RoutingException {
  public async function getResponse(
    ServerRequestInterface $_,
  ): Awaitable<ResponseInterface> {
    return Response::newEmpty()->withStatus(405);
  }
}

final class RedirectException extends HTTPException {
  public function __construct(
    private string $destination,
  ) {
    parent::__construct();
  }

  public async function getResponse(
    ServerRequestInterface $_,
  ): Awaitable<ResponseInterface> {
    return Response::newEmpty()
      ->withStatus(301)
      ->withAddedHeader('Location', $this->destination);
  }
}
