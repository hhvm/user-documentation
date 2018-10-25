<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<608f6c9f5efa9b8ff38ede30ac620b02>>
 */

abstract class RouterCodegenBase
  extends \Facebook\HackRouter\BaseRouter<classname<\RoutableController>> {

  <<__Override>>
  final public function getRoutes(
  ): ImmMap<\Facebook\HackRouter\HttpMethod, ImmMap<string, classname<\RoutableController>>> {
    $map = ImmMap {
      \Facebook\HackRouter\HttpMethod::GET => ImmMap {
        '/{Product:(?:hack|hsl|php)}/reference/{Type:(?:class|trait|interface|function)}/{Name}/' =>
          \APIClassPageController::class,
        '/{Product:(?:hack|hsl|php)}/reference/' => \APIFullListController::class,
        '/{Product:(?:hack|hsl|php)}/reference/{Type:(?:class|trait|interface|function)}/' =>
          \APIListByTypeController::class,
        '/{Product:(?:hack|hsl|php)}/reference/{Type:(?:class|trait|interface|function)}/{Class}/{Method}/' =>
          \APIMethodPageController::class,
        '/{Product:(?:hhvm|hack)}/{Guide}/{Page}' => \GuidePageController::class,
        '/{Product:(?:hhvm|hack)}/' => \GuidesListController::class,
        '/' => \HomePageController::class,
        '/j/{Keyword}' => \JumpController::class,
        '/manual/en/{LegacyId}.php' => \LegacyRedirectController::class,
        '/{Product:(?:hhvm|hack)}/{Guide}/' =>
          \RedirectToGuideFirstPageController::class,
        '/robots.txt' => \RobotsTxtController::class,
        '/search' => \SearchController::class,
        '/s/{Checksum}/{File:.+}' => \StaticResourcesController::class,
      },
    };
    return $map;
  }
}
