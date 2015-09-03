<?hh // strict

namespace HHVM\UserDocumentation;

final class GuidesHTMLBuildStep extends BuildStep {
  const string SOURCE_ROOT = __DIR__.'/../../guides';
  const string RENDERER = __DIR__.'/../../md-render/render.rb';

  public function buildAll(): void {
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '-examples') === false)
      ->map($path ==> substr($path, strlen(self::SOURCE_ROOT) + 1));

    foreach ($sources as $source) {
      $this->renderFile($source);
    }
  }

  private function renderFile(string $input): void {
    $parts = (new Vector(explode('/', $input)))
      ->map(
        $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
      );

    $output = implode('/', $parts);
    $output = dirname($output).'/'.basename($output, '.md').'.html';
    $output = BuildPaths::GUIDES_HTML.'/'.$output;

    $output_dir = dirname($output);
    if (!is_dir($output_dir)) {
      mkdir($output_dir, /* mode = */ 0755, /* recursive = */ true);
    }

    $input = realpath(self::SOURCE_ROOT.'/'.$input);
    shell_exec(sprintf("%s %s > %s", self::RENDERER, $input, $output));
  }
}
