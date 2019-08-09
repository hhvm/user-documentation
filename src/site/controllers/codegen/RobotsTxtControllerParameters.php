<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<ce5f2990b422f586026d9f55d5b28a77>>
 */

final class RobotsTxtControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape();

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape();
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
