<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<17c0730b4ad78c1ca30b046e5a1001a2>>
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
