<?hh

namespace HHVM\UserDocumentation;

final class MergedYAMLBuildStep extends BuildStep {
  public function buildAll(): void {
    $sources = (Vector { })
      ->addAll(self::findSources(BuildPaths::SYSTEMLIB_YAML, Set{'yml'}))
      ->addAll(self::findSources(BuildPaths::HHI_YAML, Set{'yml'}));
    if (!is_dir(BuildPaths::MERGED_YAML)) {
      mkdir(BuildPaths::MERGED_YAML, /* mode = */ 0755, /* recursive = */ true);
    }
    $builder = new MergedYAMLBuilder(BuildPaths::MERGED_YAML);
    foreach ($sources as $source) {
      $builder->addDefinition(\Spyc::YAMLLoad($source));
    }
    $builder->build();
  }
}
