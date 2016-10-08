<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<79d34d74bd045dc55fb7d8d4e68e369e>>
 */

class GuidesListControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

  final public function getProduct(): \HHVM\UserDocumentation\GuidesProduct {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\GuidesProduct::class,
      'Product',
    );
  }
}

trait GuidesListControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): GuidesListControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new GuidesListControllerParameters($params);
  }
}
