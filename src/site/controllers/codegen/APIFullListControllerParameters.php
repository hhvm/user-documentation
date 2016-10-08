<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<44a96b0bcbb3fe2081295e9bc34ea0c6>>
 */

class APIFullListControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

  final public function getProduct(): \HHVM\UserDocumentation\APIProduct {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\APIProduct::class,
      'Product',
    );
  }
}

trait APIFullListControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(): APIFullListControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new APIFullListControllerParameters($params);
  }
}
