<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation;

use namespace HH\Lib\{Str, Vec};

final class GuidesHTMLBuildStep extends AbstractMarkdownRenderBuildStep {
  const string SOURCE_ROOT = BuildPaths::GUIDES_MARKDOWN;
  const string BUILD_ROOT = BuildPaths::GUIDES_HTML;

  public function buildAll(): void {
    Log::i("\nGuidesHTMLBuild");
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      |> Vec\filter($$, $path ==> \basename($path) !== 'README.md')
      |> Vec\sort($$);

    $list = $this->renderFiles($sources);

    Log::i("\nCreating summaries");
    var_dump(self::SOURCE_ROOT.'/*/*/*-summary.txt');
    $summaries = \glob(self::SOURCE_ROOT.'/*/*/*-summary.txt')
      |> Vec\map($$, $path ==> Str\strip_prefix($path, self::SOURCE_ROOT.'/'))
      |> Vec\sort($$);
      var_dump($summaries);

    $summary_index = $this->createSummaryIndex($summaries);
    file_put_contents(
      BuildPaths::GUIDES_SUMMARY,
      '<?hh return '.var_export($summary_index, true).";",
    );
  }

  private function createSummaryIndex(
    Traversable<string> $summaries,
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
