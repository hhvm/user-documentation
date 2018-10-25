<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<30abba5120115b497952287914540ec2>>
 */

abstract final class GuidesListControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \GuidesListController::class;
  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\GuidesProduct,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setEnum(
        \HHVM\UserDocumentation\GuidesProduct::class,
        'Product',
        $parameters['Product'],
      )->getPath();
  }
}
