<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\TypeAssert\TypeAssert;

class ArgAssert {
  public static function isNotNull<T>(?T $value): T {
    invariant($value !== null, 'unexpected null');
    return $value;
  }

  public static function isClassname<T>(
    string $value,
    classname<T> $class,
  ): classname<T> {
    return TypeAssert::isClassnameOf(
      $class,
      $value,
    );
  }
}
