<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<4ba96b2be5d45e12479df14e609f0642>>
 */

final class APIFullListControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      'Product' => $p->getEnum(\HHVM\UserDocumentation\APIProduct::class, 'Product'),
    );
  }
}

trait APIFullListControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): APIFullListControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new APIFullListControllerParameters($raw))
      ->get();
  }
}
