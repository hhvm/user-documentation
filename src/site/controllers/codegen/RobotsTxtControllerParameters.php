<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<10f22becd0be39d7af1d18b288d79fd6>>
 */

<<Codegen>>
final class RobotsTxtControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
    );
  }
}

<<Codegen>>
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
