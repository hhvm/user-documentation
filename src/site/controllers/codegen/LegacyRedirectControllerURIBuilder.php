<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<009c4cd6740c21584f83e5e1ff236a49>>
 */

<<Codegen>>
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
