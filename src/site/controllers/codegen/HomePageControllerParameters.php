<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<b514353f3e28ff1df3a4dd2658ef926d>>
 */

final class HomePageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
  );

  public function get(): self::TParameters {
    return shape(
    );
  }
}

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
