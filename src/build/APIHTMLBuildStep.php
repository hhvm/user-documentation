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

final class APIHTMLBuildStep extends AbstractMarkdownRenderBuildStep {
  const string SOURCE_ROOT = BuildPaths::APIDOCS_MARKDOWN;
  const string BUILD_ROOT = BuildPaths::APIDOCS_HTML;

  public function buildAll(): void {
    Log::i("\nAPIHTMLBuild");
    $sources = (
      self::findSources(self::SOURCE_ROOT, Set{'md'})
      ->filter($path ==> basename($path) !== 'README.md')
      ->filter($path ==> strpos($path, '-examples') === false)
    );
    sort($sources);

    $this->renderFiles($sources);
  }

  private function renderFile(string $input): string {
    $input = str_replace(self::SOURCE_ROOT.'/', '', $input);
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
}
