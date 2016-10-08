<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<94478ff7a21c5f1942c24b504b4ef057>>
 */

class APIListByTypeControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

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

  final public function getParameters(): APIListByTypeControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIListByTypeControllerParameters($params);
  }
}
