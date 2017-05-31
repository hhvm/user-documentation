<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<e555d20fc3c2afc5755147555d8ccb2e>>
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
