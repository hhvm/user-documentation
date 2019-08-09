<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<106591c2fb0c7d3e13557723ca562d3d>>
 */

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
      ->setString('Method', $parameters['Method'])
      ->getPath();
  }
}
