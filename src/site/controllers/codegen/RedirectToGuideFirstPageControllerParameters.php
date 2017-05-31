<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<9a388cf8b2a604eb93623627b1bd2d2c>>
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
