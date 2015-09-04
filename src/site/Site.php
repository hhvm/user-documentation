<?hh // strict

namespace HHVM\UserDocumentation;

use Psr\Http\Message\ServerRequestInterface;

final class Site {
  public async function respondTo(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    list($controller, $vars) = (new Router())->routeRequest($request);
    var_dump($controller, $vars);
  }
}
