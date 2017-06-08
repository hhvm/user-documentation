<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<213e82b2c3382fbce942c655c01edd47>>
 */

<<Codegen>>
final class GuidePageControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\GuidesProduct,
    'Guide' => string,
    'Page' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "Product" => $p->getEnum(\HHVM\UserDocumentation\GuidesProduct::class, 'Product'),
      "Guide" => $p->getString('Guide'),
      "Page" => $p->getString('Page'),
    );
  }
}

<<Codegen>>
trait GuidePageControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): GuidePageControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new GuidePageControllerParameters($raw))
      ->get();
  }
}
