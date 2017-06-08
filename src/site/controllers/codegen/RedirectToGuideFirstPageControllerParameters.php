<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<62cc8f0fc5802752b69045df2db9bc86>>
 */

<<Codegen>>
final class RedirectToGuideFirstPageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\GuidesProduct,
    'Guide' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "Product" => $p->getEnum(\HHVM\UserDocumentation\GuidesProduct::class, 'Product'),
      "Guide" => $p->getString('Guide'),
    );
  }
}

<<Codegen>>
trait RedirectToGuideFirstPageControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): RedirectToGuideFirstPageControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new RedirectToGuideFirstPageControllerParameters($raw))
      ->get();
  }
}
