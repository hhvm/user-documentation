<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<faf3c34b99c14c4029895ddb6b824301>>
 */

class SearchControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

  final public function getterm(): string {
    return $this->getParameters()->getString('term');
  }
}

trait SearchControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): SearchControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new SearchControllerParameters($params);
  }
}
