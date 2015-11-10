<?hh // strict

namespace HHVM\UserDocumentation;

final class APIHTMLBuildStep extends AbstractMarkdownRenderBuildStep {
  const string SOURCE_ROOT = BuildPaths::APIDOCS_MARKDOWN;
  const string BUILD_ROOT = BuildPaths::APIDOCS_HTML;
  const string METHOD_DELIM = "method";

  public function buildAll(): void {
    Log::i("\nAPIHTMLBuild");
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '-examples') === false)
      ->map($path ==> substr($path, strlen(self::SOURCE_ROOT) + 1));
    sort($sources);

    $list = $this->renderFiles($sources);

    $this->createIndex($list);
  }

  private function renderFile(string $input): string {
    $parts = (new Vector(explode('/', $input)))
      ->map(
        $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
      );

    $output = implode('/', $parts);
    $output = basename($output, '.md').'.html';
    $output = BuildPaths::APIDOCS_HTML.'/'.$output;

    $output_dir = dirname($output);
    if (!is_dir($output_dir)) {
      mkdir($output_dir, /* mode = */ 0755, /* recursive = */ true);
    }

    $input = realpath(self::SOURCE_ROOT.'/'.$input);
    $args = (Vector {self::RENDERER, $input, $output})
      ->map($unescaped ==> escapeshellarg($unescaped));
    shell_exec(sprintf("%s %s > %s", ...$args));
    return $output;
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
