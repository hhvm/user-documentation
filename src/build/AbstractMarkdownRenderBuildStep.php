<?hh // strict

namespace HHVM\UserDocumentation;

abstract class AbstractMarkdownRenderBuildStep extends BuildStep {
  abstract const string SOURCE_ROOT;
  abstract const string BUILD_ROOT;

  const string RENDERER = __DIR__.'/../../md-render/render.rb';
  const int MAX_JOBS = 20;

  protected function renderFiles(Vector<string> $files): Vector<string> {
    Log::i("\nRendering markdown to HTML");
    $ret = Vector { };
    $jobs = Map { };

    foreach ($files as $source) {
      $input = realpath(static::SOURCE_ROOT.'/'.$source);
      $output = $this->getOutputFileName($source);
      $jobs[$input] = $output;
    }

    $pipes = [];
    $renderer = proc_open(
      self::RENDERER,
      [['pipe', 'r'], ['pipe', 'w']],
      $pipes,
      /* cwd = */ dirname(self::RENDERER),
    );
    list($stdin, $stdout) = $pipes;
    stream_set_blocking($stdout, true);

    $in_progress = 0;
    foreach ($jobs as $input => $output) {
      if ($in_progress == self::MAX_JOBS) {
        $result = $this->parseSingleRenderResult(trim(fgets($stdout)));
        --$in_progress;
        if ($result !== null) {
          $ret[] = $result;
        }
      }

      ++$in_progress;
      fprintf($stdin, "%s -> %s\n", $input, $output);
      Log::v('+');
    }
    fclose($stdin);

    while ($line = trim(fgets($stdout))) {
      $result = $this->parseSingleRenderResult($line);
      if ($result !== null) {
        $ret[] = $result;
      }
    }

    $exit_code = proc_close($renderer);
    invariant(
      $exit_code === 0,
      'Markdown renderer exited with error code %d!',
      $exit_code,
    );
    return $ret;
  }
  
  private function parseSingleRenderResult(string $line): ?string {
    if (substr($line, 0, 4) !== 'OK] ') {
      Log::v('!');
      return null;
    }
    Log::v('-');
    list($in, $out) = explode(' -> ', $line);
    // $in still has 'OK] ' prefix, but we don't need it now anyway
    return $out;
  }

  private function getOutputFileName(string $input): string {
    $parts = (new Vector(explode('/', $input)))
      ->map(
        $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
      );

    $output = implode('/', $parts);
    $output = dirname($output).'/'.basename($output, '.md').'.html';
    $output = static::BUILD_ROOT.'/'.$output;

    $output_dir = dirname($output);
    if (!is_dir($output_dir)) {
      mkdir($output_dir, /* mode = */ 0755, /* recursive = */ true);
    }

    return $output;
  }
}
