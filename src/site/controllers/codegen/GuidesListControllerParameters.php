<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<7a2b542f84ac54da327f801e84404d63>>
 */

final class GuidesListControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\GuidesProduct,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      'Product' => $p->getEnum(\HHVM\UserDocumentation\GuidesProduct::class, 'Product'),
    );
  }
}

trait GuidesListControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): GuidesListControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new GuidesListControllerParameters($raw))
      ->get();
  }
}
