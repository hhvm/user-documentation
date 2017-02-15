<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<c3e806eccf475122d39d0b47e3363646>>
 */

class GuidePageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getProduct(): \HHVM\UserDocumentation\GuidesProduct {
    return $this->getParameters()->getEnum(
      \HHVM\UserDocumentation\GuidesProduct::class,
      'Product',
    );
  }

  final public function getGuide(): string {
    return $this->getParameters()->getString('Guide');
  }

  final public function getPage(): string {
    return $this->getParameters()->getString('Page');
  }
}

trait GuidePageControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(): GuidePageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new GuidePageControllerParameters($params);
  }
}
