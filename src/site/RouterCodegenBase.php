<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<e577d989aa2f99f1ec01723886f096c6>>
 */

abstract class RouterCodegenBase
  extends \Facebook\HackRouter\BaseRouter<classname<\RoutableController>> {

  <<__Override>>
  final public function getRoutes(
  ): ImmMap<\Facebook\HackRouter\HttpMethod, ImmMap<string, classname<\RoutableController>>> {
    $get = ImmMap {
      '/' => \HomePageController::class,
      '/j/{Keyword}' => \JumpController::class,
      '/manual/en/{LegacyId}.php' => \LegacyRedirectController::class,
      '/robots.txt' => \RobotsTxtController::class,
      '/s/{Checksum}/{File:.+}' => \StaticResourcesController::class,
      '/search' => \SearchController::class,
      '/{Product:(?:hack|php)}/reference/' => \APIFullListController::class,
      '/{Product:(?:hack|php)}/reference/{Type:(?:class|trait|interface|function)}/' =>
        \APIListByTypeController::class,
      '/{Product:(?:hack|php)}/reference/{Type:(?:class|trait|interface|function)}/{Class}/{Method}/' =>
        \APIMethodPageController::class,
      '/{Product:(?:hack|php)}/reference/{Type:(?:class|trait|interface|function)}/{Name}/' =>
        \APIClassPageController::class,
      '/{Product:(?:hhvm|hack)}/' => \GuidesListController::class,
      '/{Product:(?:hhvm|hack)}/{Guide}/' =>
        \RedirectToGuideFirstPageController::class,
      '/{Product:(?:hhvm|hack)}/{Guide}/{Page}' => \GuidePageController::class,
    };
    return ImmMap {
      \Facebook\HackRouter\HttpMethod::GET => $get,
    };
  }
}
