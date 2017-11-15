<?hh // strict

namespace HHVM\UserDocumentation;

final class URLBuilder {
  public static function getPathForClass(
    shape(
      'name' => string,
      'type' => APIDefinitionType,
      ...
    ) $class,
  ): string {
    return sprintf(
      '/hack/reference/%s/%s/',
      $class['type'],
      strtr($class['name'], "\\", '.'),
    );
  }

  public static function getPathForMethod(
    shape(
      'name' => string,
      'className' => string,
      'classType' => APIDefinitionType,
      ...
    ) $method,
  ): string {
    return sprintf(
      '/hack/reference/%s/%s/%s/',
      $method['classType'],
      strtr($method['className'], "\\", '.'),
      $method['name'],
    );
  }

  public static function getPathForFunction(
    shape(
      'name' => string,
      ...
    ) $function,
  ): string {
    return sprintf(
      '/hack/reference/function/%s/',
      strtr($function['name'], "\\", '.'),
    );
  }

  public static function getPathForProductGuides(
    GuidesProduct $product,
  ): string {
    return '/'.$product.'/';
  }

  public static function getPathForGuide(
    GuidesProduct $product,
    string $topic,
  ): string {
    return self::getPathForProductGuides($product).$topic.'/';
  }

  public static function getPathForGuidePage(
    GuidesProduct $product,
    string $topic,
    string $page,
  ): string {
    return self::getPathForGuide($product, $topic).$page;
  }
}
