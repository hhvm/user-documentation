<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<6b7cf1947446648b3d7739594e14b1ee>>
 */

class GuidesListControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getProduct(): \HHVM\UserDocumentation\GuidesProduct {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\GuidesProduct::class,
      'Product',
    );
  }
}

trait GuidesListControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): GuidesListControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new GuidesListControllerParameters($params);
  }
}
