<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<f4eab66ab0d9eb76f8025f4b4d122832>>
 */

abstract final class JumpControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \JumpController::class;
  const type TParameters = shape(
    'Keyword' => string,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setString('Keyword', $parameters['Keyword'])->getPath();
  }
}
