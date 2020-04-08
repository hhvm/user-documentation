<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<f9b8fd592584bce6ebd1eef5730d18de>>
 */

final class APIClassPageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
    'Type' => \HHVM\UserDocumentation\APIDefinitionType,
    'Name' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      'Product' => $p->getEnum(\HHVM\UserDocumentation\APIProduct::class, 'Product'),
      'Type' => $p->getEnum(\HHVM\UserDocumentation\APIDefinitionType::class, 'Type'),
      'Name' => $p->getString('Name'),
    );
  }
}

trait APIClassPageControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): APIClassPageControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new APIClassPageControllerParameters($raw))
      ->get();
  }
}
