<?hh // strict

namespace HHVM\UserDocumentation;

require_once(BuildPaths::PHP_DOT_NET_API_INDEX);

final class PHPAPIIndex {
  public static function getIndex(
  ): array<string, PHPDotNetAPIIndexEntry> {
    return PHPDotNetAPIIndexData::getData();
  }


  public static function search(
    string $term,
  ): SearchResultSet {
    $results = new SearchResultSet();

    // Exact matches first
    foreach (self::getIndex() as $name => $data) {
      if (strcasecmp($name, $term) === 0) {
        $results->addPHPAPIResult($data['type'], $name, $data['url']);
      }
    }

    foreach (self::getIndex() as $name => $data) {
      $url = $data['url'];
      if (
        stripos($name, $term) !== false
        || stripos($name, $url) !== false
      ) {
        $results->addPHPAPIResult($data['type'], $name, $url);
      }
    }
    return $results;
  }
}
