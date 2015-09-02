<?hh // strict

namespace HHVM\UserDocumentation;

final class StringKeyedShapes {
  public static function toArray(shape() $shape): array<string,mixed> {
    return self::toMap($shape)->toArray();
  }

  public static function toMap(shape() $shape): Map<string,mixed> {
    $ret = Map { };
    foreach (Shapes::toArray($shape) as $key => $value) {
      invariant(
        is_string($key),
        'non-string key %s passed as key',
        var_export($key, true),
      );
      $ret[$key] = $value;
    }
    return $ret;
  }
}
