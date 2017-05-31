<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<2e2c6a4e079b9ba2e06566615af9014d>>
 */

<<Codegen>>
final class APIFullListControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "Product" => $p->getEnum(\HHVM\UserDocumentation\APIProduct::class, 'Product'),
    );
  }
}

<<Codegen>>
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
