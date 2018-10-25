<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<07b40073324926b431547e7154b08ebe>>
 */

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
