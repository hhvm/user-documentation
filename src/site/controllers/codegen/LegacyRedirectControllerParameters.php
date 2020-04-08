<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<773209667ea5c9c37559be4bd5da164b>>
 */

final class LegacyRedirectControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'LegacyId' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      'LegacyId' => $p->getString('LegacyId'),
    );
  }
}

trait LegacyRedirectControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): LegacyRedirectControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new LegacyRedirectControllerParameters($raw))
      ->get();
  }
}
