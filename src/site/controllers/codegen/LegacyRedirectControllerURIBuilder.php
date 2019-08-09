<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<3a927271fe396fefae4a80d0da7bc413>>
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
      ->setString('LegacyId', $parameters['LegacyId'])
      ->getPath();
  }
}
