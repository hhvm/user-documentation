<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<1a059f56735a0005310b2121999df1f1>>
 */

class JumpControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

  final public function getKeyword(): string {
    return $this->getParameters()->getString('Keyword');
  }
}

trait JumpControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): JumpControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new JumpControllerParameters($params);
  }
}
