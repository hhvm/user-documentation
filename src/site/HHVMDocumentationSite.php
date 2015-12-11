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
      try {
        list($controller, $vars) = (new Router())->routeRequest($request);
        return await (new $controller($vars, $request))->getResponse();
      } catch (HTTPNotFoundException $e) {
        $orig_uri = $request->getUri();
        $with_trailing_slash = $request
          ->withUri($orig_uri->withPath($orig_uri->getPath().'/'));

        try {
          list($controller, $vars) = (new Router())->routeRequest(
            $with_trailing_slash);
          // If we're here, it's routable with a trailing /
          return await (new RedirectException(
            $with_trailing_slash->getUri()->getPath()
          ))->getResponse($request);
        } catch (HTTPException $f) {
          throw $e; // original exception, not the new one
        }
      }
    } catch (HTTPException $e) {
      return await $e->getResponse($request);
    }
  }
}
