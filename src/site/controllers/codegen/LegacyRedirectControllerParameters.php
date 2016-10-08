<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<9adc8fa8149f224ba3ce3c3ab28cdae8>>
 */

class LegacyRedirectControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

  final public function getLegacyId(): string {
    return $this->getParameters()->getString('LegacyId');
  }
}

trait LegacyRedirectControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): LegacyRedirectControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new LegacyRedirectControllerParameters($params);
  }
}
