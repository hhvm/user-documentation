<?hh // strict

use Psr\Http\Message\ServerRequestInterface;

final class HHVMDocumentationSite {
  public async function respondTo(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    try {
      list($controller, $vars) = (new Router())->routeRequest($request);
      await (new $controller($vars, $request))->respond();
    } catch (HTTPException $e) {
      await $e->respond($request);
    }
  }
}
