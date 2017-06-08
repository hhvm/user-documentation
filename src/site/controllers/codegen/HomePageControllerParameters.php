<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<65c432846cd10598eae5e3abcd7a449e>>
 */

<<Codegen>>
final class HomePageControllerParameters
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
trait HomePageControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): HomePageControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new HomePageControllerParameters($raw))
      ->get();
  }
}
