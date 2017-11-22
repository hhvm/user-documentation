<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<6e9cfde3782f3d5d795755c889631ed5>>
 */

<<Codegen>>
abstract final class APIListByTypeControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \APIListByTypeController::class;
  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
    'Type' => \HHVM\UserDocumentation\APIDefinitionType,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setEnum(
        \HHVM\UserDocumentation\APIProduct::class,
        'Product',
        $parameters['Product'],
      )
      ->setEnum(
        \HHVM\UserDocumentation\APIDefinitionType::class,
        'Type',
        $parameters['Type'],
      )->getPath();
  }
}
