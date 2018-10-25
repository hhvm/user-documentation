<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<34bdcd1b7f346f3f6f62deefe83a673b>>
 */

abstract final class LegacyRedirectControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \LegacyRedirectController::class;
  const type TParameters = shape(
    'LegacyId' => string,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setString('LegacyId', $parameters['LegacyId'])->getPath();
  }
}
