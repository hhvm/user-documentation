<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<81b6dccb4ac80ff6100761c6341d7b2f>>
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
