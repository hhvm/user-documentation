<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<e48cb15cd478a49918c73bd123dea89e>>
 */

class RobotsTxtControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {
}

trait RobotsTxtControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): RobotsTxtControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new RobotsTxtControllerParameters($params);
  }
}
