<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<42aefec1e28545a455d406abbc857970>>
 */

<<Codegen>>
abstract final class RedirectToGuideFirstPageControllerURIBuilder
  extends \Facebook\HackRouter\UriBuilderCodegen {

  const classname<\Facebook\HackRouter\HasUriPattern> CONTROLLER =
    \RedirectToGuideFirstPageController::class;
  const type TParameters = shape(
    'Product' => \HHVM\UserDocumentation\GuidesProduct,
    'Guide' => string,
  );

  public static function getPath(self::TParameters $parameters): string {
    return self::createInnerBuilder()
      ->setEnum(
        \HHVM\UserDocumentation\GuidesProduct::class,
        'Product',
        $parameters['Product'],
      )
      ->setString('Guide', $parameters['Guide'])->getPath();
  }
}
