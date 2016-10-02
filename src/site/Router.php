<?hh // strict

use HHVM\UserDocumentation\ArgAssert;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\LocalConfig;

class Router {
  private function getReadOnlyRoutes(
  ): KeyedIterable<string, classname<WebController>> {
    return ImmMap {
      '/' => HomePageController::class,
      '/search' => SearchController::class,
      '/{product:(?:hack|hhvm)}/'
        => GuidesListController::class,
      '/{product:(?:hack|php)}/reference/'
        => APIFullListController::class,
      '/{product:(?:hack|php)}/reference/{type:(?:class|function|interface|trait)}/'
        => APIListByTypeController::class,
      '/{product:(?:hack|php)}/reference/{type:(?:class|function|interface|trait)}/{name}/'
        => APIClassPageController::class,
      '/{product:(?:hack)}/reference/{type:(?:class|interface|trait)}/{class}/{method}/'
        => APIMethodPageController::class,
      '/{product:(?:hack|hhvm)}/{guide}/'
        => RedirectToGuideFirstPageController::class,
      '/{product:(?:hack|hhvm)}/{guide}/{page}'
        => GuidePageController::class,
      '/manual/en/{legacy_id}.php'
        => LegacyRedirectController::class,
      '/robots.txt'
        => RobotsTxtController::class,
      '/s/{checksum}{file:/.+}'
        => StaticResourcesController::class,
      '/j/{keyword}'
        => JumpController::class,
    };
  }

  private function getWriteRoutes(
  ): KeyedIterable<string, classname<WebController>> {
    return ImmMap {
      '/__survey/go'
        => SurveyRedirectController::class,
      '/__survey/nothanks'
        => SurveyNoThanksController::class,
    };
  }

  private function getDispatcher(): \FastRoute\Dispatcher {
    return \FastRoute\cachedDispatcher(
      function(\FastRoute\RouteCollector $r): void {
        foreach ($this->getReadOnlyRoutes() as $route => $classname) {
          $r->addRoute('GET', $route, $classname);
        }

        foreach ($this->getWriteRoutes() as $route => $classname) {
          $r->addRoute('POST', $route, $classname);
        }
      },
      /* HH_FIXME[4110] nikic/fastroute#83*/
      shape(
        'cacheFile' => BuildPaths::FASTROUTE_CACHE,
        'cacheDisabled' => !LocalConfig::CACHE_ROUTES,
      ),
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
          (new Map($route[2]))
            ->map($encoded ==> urldecode($encoded))
            ->toImmMap(),
        );
    }

    invariant_violation(
      "Unknown fastroute result: %s",
      var_export($route[0], true),
    );
  }
}
