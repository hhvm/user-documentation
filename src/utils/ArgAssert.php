<?hh // strict

namespace HHVM\UserDocumentation;

class ArgAssert {
  public static function isNotNull<T>(?T $value): T {
    invariant($value !== null, 'unexpected null');
    return $value;
  }

  public static function isClassname<T>(
    mixed $value,
    classname<T> $class,
  ): classname<T> {
    invariant(
      $value === $class ||
      (is_string($value) && is_subclass_of($value, $class)),
      "'%s' is not a classname<%s>",
      var_export($value, true),
      $class,
    );
    return /* UNSAFE_EXPR */ $value;
  }
}
