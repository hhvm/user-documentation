<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<4fee165f5c3e6766720c186cb64d7694>>
 */

final class APIMethodPageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
    'Type' => \HHVM\UserDocumentation\APIDefinitionType,
    'Class' => string,
    'Method' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "Product" => $p->getEnum(\HHVM\UserDocumentation\APIProduct::class, 'Product'),
      "Type" => $p->getEnum(\HHVM\UserDocumentation\APIDefinitionType::class, 'Type'),
      "Class" => $p->getString('Class'),
      "Method" => $p->getString('Method'),
    );
  }
}

trait APIMethodPageControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): APIMethodPageControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new APIMethodPageControllerParameters($raw))
      ->get();
  }
}
