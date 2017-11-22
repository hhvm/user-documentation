<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<b4ee83ac9e80e1e10ff63bff50d23e34>>
 */

<<Codegen>>
abstract final class HomePageControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \HomePageController::class;
  const type TParameters = shape(
  );

  public static function getPath(): string {
    return self::createInnerBuilder()
      ->getPath();
  }
}
