<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<ffef25cd0a2c8aa239763969a7b8f893>>
 */

class APIMethodPageControllerParameters
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

  final public function getClass(): string {
    return $this->getParameters()->getString('Class');
  }

  final public function getMethod(): string {
    return $this->getParameters()->getString('Method');
  }
}

trait APIMethodPageControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): APIMethodPageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIMethodPageControllerParameters($params);
  }
}
