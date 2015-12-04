<?hh

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\SapiEmitter;

final class HHVMDocumentationSite {
  public static async function respondTo(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    $response = await self::getResponseForRequest($request);
    (new SapiEmitter())->emit($response);
  }

  public static async function getResponseForRequest(
    ServerRequestInterface $request,
  ): Awaitable<ResponseInterface> {
    try {
      list($controller, $vars) = (new Router())->routeRequest($request);
      return await (new $controller($vars, $request))->getResponse();
    } catch (HTTPException $e) {
      return await $e->getResponse($request);
    }
  }
}
