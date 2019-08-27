<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<b1e07f39d3f813eaf8cf22aef14b9d18>>
 */

final class RobotsTxtControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
  );

  public function get(): self::TParameters {
    return shape(
    );
  }
}

trait RobotsTxtControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): RobotsTxtControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new RobotsTxtControllerParameters($raw))
      ->get();
  }
}
