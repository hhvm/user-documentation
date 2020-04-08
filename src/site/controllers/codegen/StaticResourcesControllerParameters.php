<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<0be4c50161c03e6fb7d852e425f83b1d>>
 */

final class StaticResourcesControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Checksum' => string,
    'File' => string,
    'MTime' => ?int,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      'Checksum' => $p->getString('Checksum'),
      'File' => $p->getString('File'),
      'MTime' => $p->getOptionalInt('MTime'),
    );
  }
}

trait StaticResourcesControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): StaticResourcesControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new StaticResourcesControllerParameters($raw))
      ->get();
  }
}
