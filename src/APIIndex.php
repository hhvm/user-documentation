<?hh
namespace HHVM\UserDocumentation;

require(BuildPaths::APIDOCS_INDEX);

class APIIndex {
  public static function getIndex(
  ): APIIndexShape {
    return APIIndexData::getIndex();
  }

  public static function getProducts(): Traversable<string> {
    return array_keys(StringKeyedShapes::toArray(self::getIndex()));
  }


  public static function getReferenceForType(
    string $type,
  ): KeyedTraversable<string, APIClassIndexEntry> {
    $index = Shapes::toArray(self::getIndex());
    invariant(
      array_key_exists($type, $index),
      '%s is not in the index',
      $type,
    );
    // UNSAFE
    return $index[$type];
  }

  public static function search(string $term, SearchResultSet $results): SearchResultSet {
    // This whole method is UNSAFE
    $index = Shapes::toArray(self::getIndex());
    foreach ($index as $key => $value) {
      if (is_array($value)) {
        foreach ($value as $name => $entry) {
          if (is_string($name) && is_string($key)) {
            if (strtolower($name) === strtolower($term) || strpos(strtolower($name), strtolower($term)) !== false) {
              $results->addAPIResult($key, $name);
            }
          }
        }
      }
    }
    return $results;
  }

  public static function getFileForAPI(
    string $type,
    string $api,
    ?string $method,
  ) {
    // UNSAFE
    $index = self::getIndex();
    invariant(
      array_key_exists($type, $index),
      'Type %s does not exist',
      $type,
    );
    invariant(
      array_key_exists($api, $index[$type]),
      'Type %s does not contain reference %s',
      $type,
      $api,
    );
    if ($method !== null) {
      invariant(
        isset($index[$type][$api]['methods']),
        'API %s of type %s does not contain any methods',
        $api,
        $type,
      );
      invariant(
        array_key_exists(
          $method,
          $index[$type][$api]['methods'],
        ),
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
