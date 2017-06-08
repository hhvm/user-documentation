<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<fcf8321c11a526428a3993816cf9118d>>
 */

<<Codegen>>
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
      "Checksum" => $p->getString('Checksum'),
      "File" => $p->getString('File'),
      "MTime" => $p->getOptionalInt('MTime'),
    );
  }
}

<<Codegen>>
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
