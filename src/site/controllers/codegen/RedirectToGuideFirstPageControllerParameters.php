<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<bf25cd9396d03249bb97468330513547>>
 */

class RedirectToGuideFirstPageControllerParameters
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
}

trait RedirectToGuideFirstPageControllerParametersTrait {

  require extends \WebController;

  final public function getParameters(
  ): RedirectToGuideFirstPageControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new RedirectToGuideFirstPageControllerParameters($params);
  }
}
