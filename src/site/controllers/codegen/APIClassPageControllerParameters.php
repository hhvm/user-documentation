<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<90cc77bf4ca7f4d72a8371ff63306d0a>>
 */

class APIClassPageControllerParameters
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

  final public function getName(): string {
    return $this->getParameters()->getString('Name');
  }
}

trait APIClassPageControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): APIClassPageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIClassPageControllerParameters($params);
  }
}
