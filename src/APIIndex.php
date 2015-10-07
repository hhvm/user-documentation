<?hh

namespace HHVM\UserDocumentation;

class APIIndex {
  private static function getIndex(
  ): Map<string, Map<string, Map<string, string>>> {
    return require(BuildPaths::APIDOCS_INDEX);
  }

  public static function getProducts(): ImmVector<string> {
    return self::getIndex()->keys()->toImmVector();
  }

  public static function getClasses(): ImmVector<string> {
    $index = self::getIndex();
    invariant(
      $index->containsKey('class'),
      '%s is not in the index',
      'class',
    );
    return $index['class']->keys()->toImmVector();
  }

  public static function getFunctions(
  ): ImmVector<string> {
    $index = self::getIndex();
    invariant(
      $index->containsKey('function'),
      '%s is not in the index',
      'function',
    );
    return $index['function']->keys()->toImmVector();
  }

  public static function getFileForAPI(
    string $type,
    string $api,
  ): string {
    $index = self::getIndex();
    invariant(
      $index->containsKey($type),
      'Type %s does not exist',
      $type,
    );
    invariant(
      $index[$type]->containsKey($api),
      'Type %s does not contain reference %s',
      $type,
      $api,
    );
    return BuildPaths::APIDOCS_HTML.'/'.$index[$type][$api];
  }
}
