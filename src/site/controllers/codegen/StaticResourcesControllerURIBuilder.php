<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<fe4dac19a35d48f879e41d2e640b651a>>
 */

abstract final class StaticResourcesControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \StaticResourcesController::class;
  const type TParameters = shape(
    'Checksum' => string,
    'File' => string,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setString('Checksum', $parameters['Checksum'])
      ->setString('File', $parameters['File'])
      ->getPath();
  }
}
