<?hh // strict

namespace HHVM\UserDocumentation;

require_once(BuildPaths::PHP_DOT_NET_API_INDEX);

final class PHPAPIIndex {
  public static function getIndex(
  ): array<string, (APIDefinitionType, string)> {
    return PHPDotNetAPIIndexData::getData();
  }
}
