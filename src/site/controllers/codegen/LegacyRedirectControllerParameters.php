<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<09aece083ccf2f70f74f4bb889a01918>>
 */

class LegacyRedirectControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getLegacyId(): string {
    return $this->getParameters()->getString('LegacyId');
  }
}

trait LegacyRedirectControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): LegacyRedirectControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new LegacyRedirectControllerParameters($params);
  }
}
