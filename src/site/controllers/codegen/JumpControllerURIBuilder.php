<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<62b3546e69dd083a718e631d6b4b5893>>
 */

<<Codegen>>
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
