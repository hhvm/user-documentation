<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<79b236ad2ea14bf8726058fdadf6ae5e>>
 */

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
      "Product" =>
        $p->getEnum(\HHVM\UserDocumentation\GuidesProduct::class, 'Product'),
      "Guide" => $p->getString('Guide'),
      "Page" => $p->getString('Page'),
    );
  }
}

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
