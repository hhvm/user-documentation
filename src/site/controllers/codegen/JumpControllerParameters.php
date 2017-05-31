<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<1e0e558fd89037191bf6e1f4d5a76ee4>>
 */

<<Codegen>>
final class JumpControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'Keyword' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "Keyword" => $p->getString('Keyword'),
    );
  }
}

<<Codegen>>
trait JumpControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): JumpControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new JumpControllerParameters($raw))
      ->get();
  }
}
