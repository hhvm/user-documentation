<?hh // strict

namespace HHVM\UserDocumentation;

final class APIIndexBuildStep extends BuildStep {
  const string METHOD_DELIM = "method";

  public function buildAll(): void {
    Log::i("\nAPIIndexBuild");
    $sources = (self::findSources(BuildPaths::APIDOCS_MARKDOWN, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '-examples') === false)
      ->map($path ==> substr($path, strlen(BuildPaths::APIDOCS_MARKDOWN) + 1))
      ->map($path ==> APIHTMLBuildStep::getOutputFileName($path))
    );
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
    $out = [];
    foreach ($list as $path) {
      Log::v('.');
      $path = str_replace(BuildPaths::APIDOCS_HTML.'/', '', $path);
      $base_parts = explode('.', basename($path, '.html'), 2);

      list($type, $api) = $base_parts;
      if (!array_key_exists($type, $out)) {
        $out[$type] = [];
      }
      $api_parts = explode('.', $api);

      if (in_array(self::METHOD_DELIM, $api_parts, TRUE)) {
        $method_sep_index = array_search(self::METHOD_DELIM, $api_parts, true);
        $method_index = $method_sep_index + 1;
        invariant(
          array_key_exists($method_index, $api_parts),
          "Method at key %s does not exist in %s filename",
          $method_index,
          $path,
        );
        $parent_api = rtrim(explode(self::METHOD_DELIM, $api)[0], ".");
        $method = $api_parts[$method_index];

        if (!array_key_exists($parent_api, $out[$type])) {
          $out[$type][$parent_api] = ["path" => "", "methods" => []];
        }
        $out[$type][$parent_api]["methods"][$method] = $path;
      } else {
        if (!array_key_exists($api, $out[$type])) {
          $out[$type][$api] = ["path" => "", "methods" => []];
        }
        $out[$type][$api]["path"] = $path;
      }
    }
    // UNSAFE
    return $out;
  }
}
