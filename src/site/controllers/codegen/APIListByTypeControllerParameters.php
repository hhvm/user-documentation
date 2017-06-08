<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<a24002fb5172cc93702895dee38704c1>>
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
