<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<376347537cdde57340dc1f139cd59156>>
 */

class RedirectToGuideFirstPageControllerParameters
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
}

trait RedirectToGuideFirstPageControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(
  ): RedirectToGuideFirstPageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new RedirectToGuideFirstPageControllerParameters($params);
  }
}
