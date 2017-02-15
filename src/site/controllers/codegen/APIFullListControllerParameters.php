<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<a3285640ceecc2545713b593a0d7b94e>>
 */

class APIFullListControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getProduct(): \HHVM\UserDocumentation\APIProduct {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\APIProduct::class,
      'Product',
    );
  }
}

trait APIFullListControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): APIFullListControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIFullListControllerParameters($params);
  }
}
