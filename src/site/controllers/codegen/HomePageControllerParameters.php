<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<7f95002c11fcb4e7d4d9ffc7c546bd90>>
 */

class HomePageControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {
}

trait HomePageControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): HomePageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new HomePageControllerParameters($params);
  }
}
