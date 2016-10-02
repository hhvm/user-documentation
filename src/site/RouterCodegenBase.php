<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<4b3584e75a767e12b22ee296e869dc91>>
 */

abstract class RouterCodegenBase
  extends \FredEmmott\HackRouter\BaseRouter<classname<\RoutableController>> {

  <<__Override>>
  final public function getRoutes(
  ): ImmMap<\FredEmmott\HackRouter\HttpMethod, ImmMap<string, classname<\RoutableController>>> {
    $get = ImmMap {
      '/' => \HomePageController::class,
      '/j/{keyword}' => \JumpController::class,
      '/manual/en/{legacy_id}.php' => \LegacyRedirectController::class,
      '/robots.txt' => \RobotsTxtController::class,
      '/s/{checksum}/{file:.+}' => \StaticResourcesController::class,
      '/search' => \SearchController::class,
      '/{product:(?:hack|php)}/reference/' => \APIFullListController::class,
      '/{product:(?:hack|php)}/reference/{type:(?:class|trait|interface|function)}/' =>
        \APIListByTypeController::class,
      '/{product:(?:hack|php)}/reference/{type:(?:class|trait|interface|function)}/{class}/{method}/' =>
        \APIMethodPageController::class,
      '/{product:(?:hack|php)}/reference/{type:(?:class|trait|interface|function)}/{name}/' =>
        \APIClassPageController::class,
      '/{product:(?:hhvm|hack)}/' => \GuidesListController::class,
      '/{product:(?:hhvm|hack)}/{guide}/' =>
        \RedirectToGuideFirstPageController::class,
      '/{product:(?:hhvm|hack)}/{guide}/{page}' => \GuidePageController::class,
    };
    return ImmMap {
      \FredEmmott\HackRouter\HttpMethod::GET => $get,
    };
  }
}
