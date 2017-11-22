<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<facd5c6880cb75bcf36eaf44c8fd7f15>>
 */

<<Codegen>>
abstract final class APIMethodPageControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \APIMethodPageController::class;
  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\APIProduct,
    'Type' => \HHVM\UserDocumentation\APIDefinitionType,
    'Class' => string,
    'Method' => string,
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
      )
      ->setString('Class', $parameters['Class'])
      ->setString('Method', $parameters['Method'])->getPath();
  }
}
