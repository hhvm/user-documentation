<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<e28caf6902d570574516ff1fd790bee4>>
 */

<<Codegen>>
abstract final class GuidePageControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \GuidePageController::class;
  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\GuidesProduct,
    'Guide' => string,
    'Page' => string,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setEnum(
        \HHVM\UserDocumentation\GuidesProduct::class,
        'Product',
        $parameters['Product'],
      )
      ->setString('Guide', $parameters['Guide'])
      ->setString('Page', $parameters['Page'])->getPath();
  }
}
