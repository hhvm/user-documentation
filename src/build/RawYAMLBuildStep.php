<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\FileParser;

final class RawYAMLBuildStep extends BuildStep {
  public function buildAll(): void {
    $exts = Set { 'php', 'hhi' };

    $sources = (Vector { })
      ->addAll(self::findSources(LocalConfig::HHVM_TREE.'/hphp/system/php/', $exts))
      ->addAll(self::findSources(LocalConfig::HHVM_TREE.'/hphp/runtime/ext/', $exts));
    $this->buildSources(
      LocalConfig::BUILD_DIR.'/systemlib',
      $sources,
    );
    
    $this->buildSources(
      LocalConfig::BUILD_DIR.'/hhi',
      self::findSources(LocalConfig::HHVM_TREE.'/hphp/hack/hhi/', $exts),
    );
  }

  private function buildSources(
    string $output_dir,
    Iterable<string> $sources,
  ): void {
    foreach ($sources as $filename) {
      $source = shape(
        'type' => DocumentationSourceType::FILE,
        'name' => $filename,
        'mtime' => stat($filename)['mtime'],
      );
      $bytes = file_get_contents($filename);
      $parser = FileParser::FromData($bytes, $filename);
      (new ScannedDefinitionsYAMLBuilder($source, $parser, $output_dir))
        ->addFilter($x ==> ScannedDefinitionFilters::IsHHSpecific($x))
        ->addFilter($x ==> !ScannedDefinitionFilters::ShouldNotDocument($x))
        ->build();
    }
  }
}
