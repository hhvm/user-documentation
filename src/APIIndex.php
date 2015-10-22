<?hh

namespace HHVM\UserDocumentation;

class APIIndex {
  private static function getIndex(
  ): Map<string, Map<string, APIClassIndexEntry>> {
    return require(BuildPaths::APIDOCS_INDEX);
  }

  public static function getProducts(): ImmVector<string> {
    return self::getIndex()->keys()->toImmVector();
  }
  
  public static function getReferenceForType(
    string $type,
  ): Map<string, APIClassIndexEntry> {
    $index = self::getIndex();
    invariant(
      $index->containsKey($type),
      '%s is not in the index',
      $type,
    );
    return $index[$type];
  }

  public static function getFileForAPI(
    string $type,
    string $api,
    ?string $method,
  ) {
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
    invariant(
      isset($index[$type][$api]['path']),
      'API %s of type %s does not contain a path',
      $api,
      $type,
    );
    if ($method !== null) {
      invariant(
        isset($index[$type][$api]['methods']),
        'API %s of type %s does not contain any methods',
        $api,
        $type,
      );
      invariant(
        $index[$type][$api]['methods'][$method],
        'API %s of type %s does not contain method %s',
        $api,
        $type,
        $method,
      );
      $api_file = (string) $index[$type][$api]['methods'][$method];
    } else {
      $api_file = (string) $index[$type][$api]['path'];
    }
    return 
      BuildPaths::APIDOCS_HTML.'/'. $api_file;
  }
}
