<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<f019e32ce80af464cf311684dcd43026>>
 */

<<Codegen>>
final class LegacyRedirectControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'LegacyId' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "LegacyId" => $p->getString('LegacyId'),
    );
  }
}

<<Codegen>>
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
