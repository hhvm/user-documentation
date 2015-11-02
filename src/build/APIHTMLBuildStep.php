<?hh // strict

namespace HHVM\UserDocumentation;

final class APIHTMLBuildStep extends BuildStep {
  const string SOURCE_ROOT = __DIR__.'/../../build/apidocs';
  const string RENDERER = __DIR__.'/../../md-render/render.rb';
  const string METHOD_DELIM = "method";

  public function buildAll(): void {
    Log::i("\nAPIHTMLBuild");
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '-examples') === false)
      ->map($path ==> substr($path, strlen(self::SOURCE_ROOT) + 1));
    sort($sources);

    $list = Vector { };
    $bucket = Vector { };
    $threads = 5;
    // Prepare buckets which will contain the commands to be executed
    // inside of a fork. Every fork gets its own bucket to work on.
    for ($i = 0; $i < $threads; ++$i) {
      $bucket[] = Vector { };
    }
    $i = 0;
    foreach ($sources as $input) {
      list($output, $command) = $this->prepareRenderFile($input);
      $list[] = $output;
      $bucket[$i++ % $threads][] = $command;
    }
    assert($bucket->count() == $threads);

    $children = Vector { };
    for ($i = 0; $i < $threads; ++$i) {
      $pid = pcntl_fork();
      if ($pid == -1) {
        Log::e("Could not fork.");
      } else if ($pid) { // parent
        $children[] = $pid;
      } else { // children
        foreach ($bucket[$i] as $command) {
          Log::v('.');
          shell_exec($command);
        }
        exit();
      }
    }

    Log::i("Waiting for render to finish.");
    foreach ($children as $child) {
      pcntl_wait($child);
    }

    $index = $this->createIndex($list);
    file_put_contents(
      BuildPaths::APIDOCS_INDEX,
      '<?hh return '.var_export($index, true).";",
    );
  }

  private function prepareRenderFile(
    string $input
  ): Pair<string, string> {
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
    $command = sprintf("%s %s > %s", self::RENDERER, $input, $output);
    return Pair {$output, $command};
  }

  private function createIndex(
    Iterable<string> $list,
  ): Map<string, Map<string, Map<string, mixed>>> {
    Log::i("\nCreate Index");
    $out = Map { };
    foreach ($list as $path) {
      Log::v('.');
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
