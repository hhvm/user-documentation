<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<bccba86097c2f293d2c701ecfc8e2f4e>>
 */

class APIClassPageControllerParameters
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

  final public function getName(): string {
    return $this->getParameters()->getString('Name');
  }
}

trait APIClassPageControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): APIClassPageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIClassPageControllerParameters($params);
  }
}
