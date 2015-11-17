<?hh // strict

namespace HHVM\UserDocumentation;

final class StaticResourceMapBuildStep extends BuildStep {
  use CodegenBuildStep;
 
  private static function getTypes(): Map<string, string> {
    return Map {
      'css' => 'text/css',
      'js' => 'application/javascript',
      'png' => 'image/png',
    };
  }

  <<__Memoize>>
  private static function getRoot(): string {
    return realpath(LocalConfig::ROOT.'/public/');
  }

  public function buildAll(): void {
    Log::i("\nStaticResourcesMapBuild");

    $sources = self::findSources(
      self::getRoot(),
      self::getTypes()->keys()->toSet(),
    );

    $map = self::makeMap($sources);

    // For PHP
    $code = $this->writeCode(
      'StaticResourceData.hhi',
      $map,
    );
    file_put_contents(
      BuildPaths::STATIC_RESOURCES_MAP,
      $code,
    );

    // For Ruby (md-render)
    file_put_contents(
      BuildPaths::STATIC_RESOURCES_MAP_JSON,
      json_encode($map, JSON_PRETTY_PRINT),
    );
  }

  private static function makeMap(
    Vector<string> $sources,
  ): array<string, StaticResourceMapEntry> {
    $map = [];

    $prefix_len = strlen(self::getRoot());

    $mimetype_map = self::getTypes();

    foreach ($sources as $source) {
      $relative = substr($source, $prefix_len);
      $full_hash = hash('sha256', file_get_contents($source));
      $ext = pathinfo($source, PATHINFO_EXTENSION);

      $map[$relative] = shape(
        'localPath' => $source,
        'checksum' => substr($full_hash, 0, 16),
        'mtime' => filemtime($source),
        'mimeType' => $mimetype_map->at($ext),
      );
    }

    return $map;
  }
}
