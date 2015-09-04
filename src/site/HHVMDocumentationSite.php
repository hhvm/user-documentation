<?hh // strict

use Psr\Http\Message\ServerRequestInterface;

final class HHVMDocumentationSite {
  public async function respondTo(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    list($controller, $vars) = (new Router())->routeRequest($request);
    await (new $controller($vars))->respond();
  }
}
