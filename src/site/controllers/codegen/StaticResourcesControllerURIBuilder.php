<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<e4d8bbc99e3f41d53e63ee27c74cbfa1>>
 */

<<Codegen>>
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
      ->setString('File', $parameters['File'])->getPath();
  }
}
