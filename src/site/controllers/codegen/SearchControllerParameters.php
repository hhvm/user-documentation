<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run
 * /Users/mickeyp/hhvm-docs/user-documentation/bin/build.php
 *
 *
 * @generated SignedSource<<ab0f27d915ba9dbb3b232f71b04908b2>>
 */

<<Codegen>>
final class SearchControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'term' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      "term" => $p->getString('term'),
    );
  }
}

<<Codegen>>
trait SearchControllerParametersTrait {

  require extends \WebController;

  <<__Memoize>>
  final protected function getParameters(
  ): SearchControllerParameters::TParameters {
    $raw = $this->getParameters_PRIVATE_IMPL();
    return (new SearchControllerParameters($raw))
      ->get();
  }
}
