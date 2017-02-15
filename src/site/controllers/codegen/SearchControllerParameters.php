<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<ad495885baf9a41575211260f9a59849>>
 */

class SearchControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getterm(): string {
    return $this->getParameters()->getString('term');
  }
}

trait SearchControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): SearchControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new SearchControllerParameters($params);
  }
}
