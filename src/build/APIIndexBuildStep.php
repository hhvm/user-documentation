<?hh

namespace HHVM\UserDocumentation;

final class APIIndexBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nAPIIndexBuild");

    $sources = self::findSources(BuildPaths::MERGED_YAML, Set{'yml'});
    sort($sources);

    $this->createIndex($sources);
  }

  private function createIndex(
    Iterable<string> $list,
  ): void {
    $index = $this->generateIndexData($list);
    /* TODO: Use hack-codegen once
     * https://github.com/facebook/hack-codegen/issues/7 is addressed? */
    $code = file_get_contents(__DIR__.'/../APIIndexData.hhi');

    $re = $s ==> '/'.preg_quote($s, '/').'/';

    $replacements = [
      $re('<?hh // decl') => '<?php',
      '/\): [^{]+{/' => ') {',
      $re('/* CODEGEN GOES HERE */') => 'return '.var_export($index, true).';',
    ];
    foreach ($replacements as $pattern => $replacement) {
      $code = preg_replace($pattern, $replacement, $code);
    }
    file_put_contents(
      BuildPaths::APIDOCS_INDEX,
      $code,
    );
  }

  private function generateIndexData(
    Iterable<string> $list,
  ): APIIndexShape {

    Log::i("\nCreate Index");
    $out = shape(
      'class' => [],
      'interface' => [],
      'trait' => [],
      'function' => [],
    );
    foreach ($list as $yaml_path) {
      Log::v('.');
      $data = ((): BaseYAML ==> \Spyc::YAMLLoad($yaml_path))(); // cast :p

      $type = $data['type'];
      switch ($type) {
        case APIDefinitionType::FUNCTION_DEF:
          $docs = (
            (): FunctionDocumentation ==> /* UNSAFE_EXPR */ $data['data']
          )();

          $idx = strtr($docs['name'], "\\", '.');
          $md_path = FunctionMarkdownBuilder::getOutputFileName($docs);
          $html_path = self::markdownPathToHTMLPath($md_path);

          $out['function'][$idx] = shape(
            'path' => $html_path,
            'methods' => [],
          );
          break;
        case APIDefinitionType::CLASS_DEF:
        case APIDefinitionType::INTERFACE_DEF:
        case APIDefinitionType::TRAIT_DEF:
          $docs = (
            (): ClassDocumentation ==> /* UNSAFE_EXPR */ $data['data']
          )();


          $methods = [];
          foreach ($docs['methods'] as $method) {
            $idx = strtr($method['name'], "\\", '.');
            $md_path = MethodMarkdownBuilder::getOutputFileName(
              $type,
              $docs,
              $method,
            );
            $html_path = self::markdownPathToHTMLPath($md_path);
            $methods[$idx] = $html_path;
          }

          $md_path = ClassMarkdownBuilder::getOutputFileName(
            $type,
            $docs,
          );
          $html_path = self::markdownPathToHTMLPath($md_path);

      
          $idx = strtr($docs['name'], "\\", '.');
          $entry = shape(
            'path' => $html_path,
            'methods' => $methods,
          );

          switch ($type) {
            case APIDefinitionType::CLASS_DEF:
              $out['class'][$idx] = $entry;
              break;
            case APIDefinitionType::INTERFACE_DEF:
              $out['interface'][$idx] = $entry;
              break;
            case APIDefinitionType::TRAIT_DEF:
              $out['trait'][$idx] = $entry;
              break;
            case APIDefinitionType::FUNCTION_DEF:
              invariant_violation('unreachable');
          }
          break;
      }
    }

    return $out;
  }

  private static function markdownPathToHTMLPath(string $md_path): string {
    $md_relative = substr(
      $md_path,
      strlen(BuildPaths::APIDOCS_MARKDOWN) + 1,
    );
    $html_absolute = APIHTMLBuildStep::getOutputFileName($md_relative);
    $html_relative = str_replace(
      BuildPaths::APIDOCS_HTML.'/',
      '',
      $html_absolute,
    );
    return $html_relative;
  }
}
