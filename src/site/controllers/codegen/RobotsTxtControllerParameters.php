<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<5ae61f2ff836f39a5999dac8a218fdf2>>
 */

class RobotsTxtControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {
}

trait RobotsTxtControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): RobotsTxtControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new RobotsTxtControllerParameters($params);
  }
}
