<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<fcc66daf42840834b7d255354dfc7278>>
 */

class JumpControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getKeyword(): string {
    return $this->getParameters()->getString('Keyword');
  }
}

trait JumpControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): JumpControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new JumpControllerParameters($params);
  }
}
