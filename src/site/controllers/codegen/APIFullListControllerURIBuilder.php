<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<6f21b6c4c7d232af2d41b2c369b3cbb8>>
 */

<<Codegen>>
abstract final class APIFullListControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \APIFullListController::class;
  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setEnum(
        \HHVM\UserDocumentation\APIProduct::class,
        'Product',
        $parameters['Product'],
      )->getPath();
  }
}
