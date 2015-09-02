<?hh

namespace HHVM\UserDocumentation;

final class MergedYAMLBuildStep extends BuildStep {
  public function buildAll(): void {
    $sources = (Vector { })
      ->addAll(self::findSources(LocalConfig::BUILD_DIR.'/systemlib', Set{'yml'}))
      ->addAll(self::findSources(LocalConfig::BUILD_DIR.'/hhi', Set{'yml'}));
    $builder = new MergedYAMLBuilder(LocalConfig::BUILD_DIR.'/merged');
    foreach ($sources as $source) {
      $builder->addDefinition(\Spyc::YAMLLoad($source));
    }
    $builder->build();
  }
}
