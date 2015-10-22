<?hh // strict

namespace HHVM\UserDocumentation;

final class APIHTMLBuildStep extends BuildStep {
  const string SOURCE_ROOT = __DIR__.'/../../build/apidocs';
  const string RENDERER = __DIR__.'/../../md-render/render.rb';
  const string METHOD_DELIM = "method";

  public function buildAll(): void {
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '-examples') === false)
      ->map($path ==> substr($path, strlen(self::SOURCE_ROOT) + 1));
    sort($sources);

    $list = Vector { };
    foreach ($sources as $input) {
      $output = $this->renderFile($input);
      $list[] = $output;
    }
    
    $index = $this->createIndex($list);
    file_put_contents(
      BuildPaths::APIDOCS_INDEX,
      '<?hh return '.var_export($index, true).";",
    );
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
    shell_exec(sprintf("%s %s > %s", self::RENDERER, $input, $output));
    return $output;
  }

  private function createIndex(
    Iterable<string> $list,
  ): Map<string, Map<string, Map<string, mixed>>> {
    $out = Map { };
    foreach ($list as $path) {
      $path = str_replace(BuildPaths::APIDOCS_HTML.'/', '', $path);
      $base_parts = explode('.', basename($path, '.html'), 2);
      
      list($type, $api) = $base_parts;    
      if (!$out->contains($type)) {
        $out[$type] = Map {};
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
        
        if (!$out[$type]->contains($parent_api)) {
          $out[$type][$parent_api] = Map {"path" => "", "methods" => Map{}};
        }
        $out[$type][$parent_api]["methods"][$method] = $path;
      } else {
        if (!$out[$type]->contains($api)) {
          $out[$type][$api] = Map {"path" => "", "methods" => Map{}};
        }
        $out[$type][$api]["path"] = $path;
      }
    }
    return $out;
  }
}
