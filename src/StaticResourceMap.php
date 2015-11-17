<?hh // strict
namespace HHVM\UserDocumentation;

require(BuildPaths::STATIC_RESOURCES_MAP);

class StaticResourceMap {
  private static function getMap(): array<string, StaticResourceMapEntry> {
    return StaticResourceData::getData();
  }

  public static function getEntryForFile(
    string $filename,
  ): StaticResourceMapEntry {
    $map = self::getMap();
    invariant(
      array_key_exists($filename, $map),
      "Filename not in map: %s",
      $filename,
    );
    return $map[$filename];
  }
}
