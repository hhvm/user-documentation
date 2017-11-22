<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<e0a697508d1be8db4cc951702766a20e>>
 */

<<Codegen>>
abstract final class SearchControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \SearchController::class;
  const type TParameters = shape(
  );

  public static function getPath(): string {
    return self::createInnerBuilder()
      ->getPath();
  }
}
