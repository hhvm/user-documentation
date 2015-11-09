<?hh // strict

namespace HHVM\UserDocumentation;

enum APIType: string {
  CLASS_TYPE = "class";
  INTERFACE_TYPE = "interface";
  TRAIT_TYPE = "trait";
  FUNCTION_TYPE = "function";
}

final class MergedMarkdownBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nMergedMarkdownBuild");
    $sources = (Vector { })
      ->addAll(self::findSources(BuildPaths::MERGED_YAML, Set{'yml'}));
    if (!is_dir(BuildPaths::APIDOCS_MARKDOWN)) {
      mkdir(BuildPaths::APIDOCS_MARKDOWN, /* mode = */ 0755, /* recursive = */ true);
    }
    foreach ($sources as $source) {
      Log::v('.');
      $filename = pathinfo($source)['filename'];
      $type = explode('.', $filename)[0];
      $output_path = BuildPaths::APIDOCS_MARKDOWN.'/'.$filename.'.md';
      switch ($type) {
        case "function":
          $builder = new FunctionMarkdownBuilder($source);
          file_put_contents($output_path, $builder->build());
          break;
        case "class":
        case "interface":
        case "trait":
          $builder = new ClassMarkdownBuilder($source);
          file_put_contents($output_path, $builder->build());
          $method_builder = new MethodMarkdownBuilder($source);
          $method_builder->buildAll();
          break;
        default:
          invariant(
            APIType::isValid($type),
            "'%s' is an unexpected API type.",
            $type,
          );
          break;
      }
    }
  }
}
