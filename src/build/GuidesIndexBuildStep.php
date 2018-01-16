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

final class GuidesIndexBuildStep extends BuildStep {

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nGuidesIndexBuild");

    $sources = self::findSources(BuildPaths::GUIDES_MARKDOWN, Set{'md'});
    sort(&$sources);

    $this->createIndex($sources);
  }

  private function createIndex(
    Traversable<string> $list,
  ): void {
    $index = $this->generateIndexData($list);

    file_put_contents(
      BuildPaths::GUIDES_INDEX,
      '<?hh return '.var_export($index, true).";",
    );
  }

  private function generateIndexData(
    Traversable<string> $sources,
  ): Map<string, Map<string, Map<string, string>>> {
    $out = Map { };
    foreach ($sources as $path) {
      $path = str_replace(BuildPaths::GUIDES_MARKDOWN.'/', '', $path);
      $parts = (new Vector(explode('/', $path)))
        ->map(
          $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
        );
      if (count($parts) !== 3) {
        continue;
      }

      list($product, $section, $page) = $parts;
      $page = basename($page, '.md');
      if (!$out->contains($product)) {
        $out[$product] = Map {};
      }
      if (!$out[$product]->contains($section)) {
        $out[$product][$section] = Map { };
      }

      $absolute = GuidesHTMLBuildStep::getOutputFileName($path);
      $relative = substr($absolute, strlen(BuildPaths::GUIDES_HTML) + 1);
      $out[$product][$section][$page] = $relative;
    }
    return $out;
  }
}
