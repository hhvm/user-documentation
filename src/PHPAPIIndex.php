<?hh // strict

namespace HHVM\UserDocumentation;

require_once(BuildPaths::PHP_DOT_NET_API_INDEX);

final class PHPAPIIndex {
  public static function getIndex(
  ): array<string, (APIDefinitionType, string)> {
    return PHPDotNetAPIIndexData::getData();
  }


  public static function search(
    string $term,
  ): SearchResultSet {
    $results = new SearchResultSet();

    // Exact matches first
    foreach (self::getIndex() as $name => $data) {
      if (strcasecmp($name, $term) === 0) {
        list($type, $url) = $data;
        $results->addPHPAPIResult($type, $name, $url);
      }
    }

    foreach (self::getIndex() as $name => $data) {
      list($type, $url) = $data;
      if (
        stripos($name, $term) !== false
        || stripos($name, $url) !== false
      ) {
        $results->addPHPAPIResult($type, $name, $url);
      }
    }
    return $results;
  }
}
