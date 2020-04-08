<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<e08e44a55026311f7186261249a26fd0>>
 */

final class SearchControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  const type TParameters = shape(
    'term' => string,
  );

  public function get(): self::TParameters {
    $p = $this->getParameters();
    return shape(
      'term' => $p->getString('term'),
    );
  }
}

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
