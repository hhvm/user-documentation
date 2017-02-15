<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<b56e670cfa0396d329e493c08963eda6>>
 */

class APIListByTypeControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getProduct(): \HHVM\UserDocumentation\APIProduct {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\APIProduct::class,
      'Product',
    );
  }

  final public function getType(): \HHVM\UserDocumentation\APIDefinitionType {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\APIDefinitionType::class,
      'Type',
    );
  }
}

trait APIListByTypeControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): APIListByTypeControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIListByTypeControllerParameters($params);
  }
}
