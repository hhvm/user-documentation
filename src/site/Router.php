<?hh // strict

use HHVM\UserDocumentation\ArgAssert;

class Router {
  private function getRoutes(
  ): KeyedIterable<string, classname<WebController>> {
    return ImmMap {
      '/' => HomePageController::class,
      '/{product:(?:hack|hhvm)}/'
        => GuidesListController::class,
      '/{product:(?:hack)}/reference/'
        => APIListController::class,
      '/{product:(?:hack)}/reference/{type:(?:class|function)}/{api}/'
        => APIPageController::class,
      '/{product:(?:hack|hhvm)}/{guide}/'
        => RedirectToGuideFirstPageController::class,
      '/{product:(?:hack|hhvm)}/{guide}/{page}'
        => GuidePageController::class,
    };
  }

  private function getDispatcher(): \FastRoute\Dispatcher {
    return \FastRoute\simpleDispatcher(
      function(\FastRoute\RouteCollector $r): void {
        foreach ($this->getRoutes() as $route => $classname) {
          $r->addRoute('GET', $route, $classname);
        }
      }
    );
  }

  public function routeRequest(
    \Psr\Http\Message\ServerRequestInterface $request
  ): (classname<WebController>, ImmMap<string, string>) {
    $path = $request->getUri()->getPath();
    $route = $this->getDispatcher()->dispatch(
      $request->getMethod(),
      $path,
    );
    switch ($route[0]) {
      case \FastRoute\Dispatcher::NOT_FOUND:
        throw new HTTPNotFoundException($path);
      case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        throw new HTTPMethodNotAllowedException($path);
      case \FastRoute\Dispatcher::FOUND:
        return tuple(
          ArgAssert::isClassname($route[1], WebController::class),
          new ImmMap($route[2]),
        );
    }

    invariant_violation(
      "Unknown fastroute result: %s",
      var_export($route[0], true),
    );
  }
}
