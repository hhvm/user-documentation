<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<cccca7bd6847de9b663f2a7d23bc0b76>>
 */

<<Codegen>>
final class APIListByTypeControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
    'Type' => \HHVM\UserDocumentation\APIDefinitionType,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "Product" => $p->getEnum(\HHVM\UserDocumentation\APIProduct::class, 'Product'),
      "Type" => $p->getEnum(\HHVM\UserDocumentation\APIDefinitionType::class, 'Type'),
    );
  }
}

<<Codegen>>
trait APIListByTypeControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): APIListByTypeControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new APIListByTypeControllerParameters($raw))
      ->get();
  }
}
