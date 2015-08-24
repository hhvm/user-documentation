<?hh // strict

namespace HHVM\UserDocumentation;

class ArgAssert {
  public static function isNotNull<T>(?T $value): T {
    invariant($value !== null, 'unexpected null');
    return $value;
  }
}
