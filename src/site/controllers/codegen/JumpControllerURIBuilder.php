<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<e69eef3e094999831f7779b871607ea9>>
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
      ->setString('Keyword', $parameters['Keyword'])
      ->getPath();
  }
}
