<?hh // strict

namespace HHVM\UserDocumentation;

final class GuidesHTMLBuildStep extends AbstractMarkdownRenderBuildStep {
  const string SOURCE_ROOT = __DIR__.'/../../guides';
  const string BUILD_ROOT = BuildPaths::GUIDES_HTML;

  public function buildAll(): void {
    Log::i("\nGuidesHTMLBuild");
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '99-api-examples') === false)
      ->map($path ==> substr($path, strlen(self::SOURCE_ROOT) + 1));
    sort($sources);

    $list = $this->renderFiles($sources);

    Log::i("\nCreating index");
    $index = $this->createIndex($list);
    file_put_contents(
      BuildPaths::GUIDES_INDEX,
      '<?hh return '.var_export($index, true).";",
    );

    $summaries = self::findSources(self::SOURCE_ROOT, Set{'txt'})
      ->filter($path ==> strpos($path, '-summary') !== false)
      ->map($path ==> substr($path, strlen(self::SOURCE_ROOT) + 1));
    sort($summaries);
    $summary_index = $this->createSummaryIndex($summaries);
    file_put_contents(
      BuildPaths::GUIDES_SUMMARY,
      '<?hh return '.var_export($summary_index, true).";",
    );
  }

  private function createIndex(
    Iterable<string> $list,
  ): Map<string, Map<string, Map<string, string>>> {
    $out = Map { };
    foreach ($list as $path) {
      $path = str_replace(BuildPaths::GUIDES_HTML.'/', '', $path);
      $parts = explode('/', $path);
      if (count($parts) !== 3) {
        continue;
      }

      list($product, $section, $page) = $parts;
      $page = basename($page, '.html');
      if (!$out->contains($product)) {
        $out[$product] = Map {};
      }
      if (!$out[$product]->contains($section)) {
        $out[$product][$section] = Map { };
      }
      $out[$product][$section][$page] = $path;
    }
    return $out;
  }

  private function createSummaryIndex(
    Iterable<string> $summaries,
  ): Map<string, Map<string, string>> {
    $out = Map { };
    foreach ($summaries as $summary) {
      $parts = (new Vector(explode('/', $summary)))
        ->map(
          $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
        );
      if (count($parts) !== 3) {
        continue;
      }
      list($product, $section, $page) = $parts;
      if (!$out->contains($product)) {
        $out[$product] = Map {};
      }
      $out[$product][$section] = $summary;
    }
    return $out;
  }
}
