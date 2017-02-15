<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<44e8b3c0467715daaafd790ac22fcf15>>
 */

class HomePageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {
}

trait HomePageControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): HomePageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new HomePageControllerParameters($params);
  }
}
