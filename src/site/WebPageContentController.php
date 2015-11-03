<?hh // strict

use Psr\Http\Message\ServerRequestInterface;

final class WebPageContentController extends WebController {
  public function __construct(
    ImmMap<string,string> $parameters,
    protected ServerRequestInterface $request,
  ) {
    parent::__construct($parameters, $request);
  }
    
  final public async function respond(): Awaitable<void> {
    $path = $this->getRequiredStringParam('path');
    $controller = $this->getDelegateControllerForPath($path);
    invariant(
      $controller instanceof WebPageController,
      'Trying to get content from %s, which is not a WebPageController',
      get_class($controller),
    );

    list($title, $content_xhp) = await HH\Asio\va2(
      $controller->getTitle(),
      $controller->getContentPane(),
    );
    // https://github.com/facebook/xhp-lib/issues/152
    $content = await (<x:frag>{$content_xhp}</x:frag>)->asyncToString();
    header('Content-type: application/json');
    print json_encode([
      'title' => $title,
      'content' => $content,
    ]);
  }

  protected function getDelegateControllerForPath(string $path): WebController {
    $request = (
      $this->request
      ->withUri($this->request->getUri()->withPath($path))
      ->withQueryParams([])
    );
    list($class, $params) = (new Router())->routeRequest($request);
    return new $class($params, $request);
  }
}
