<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<40c1d8fc23c269471b6d8dcfdddc8123>>
 */

class APIMethodPageControllerParameters
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

  final public function getClass(): string {
    return $this->getParameters()->getString('Class');
  }

  final public function getMethod(): string {
    return $this->getParameters()->getString('Method');
  }
}

trait APIMethodPageControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): APIMethodPageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIMethodPageControllerParameters($params);
  }
}
