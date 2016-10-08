<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<b0d60ca12dd3b73d6c9ee91c0223e49b>>
 */

class GuidePageControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

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

  final public function getParameters(): GuidePageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new GuidePageControllerParameters($params);
  }
}
