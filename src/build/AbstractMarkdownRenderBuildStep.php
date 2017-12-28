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
use namespace Facebook\Markdown;

abstract class AbstractMarkdownRenderBuildStep extends BuildStep {
  abstract const string SOURCE_ROOT;
  abstract const string BUILD_ROOT;

  const int MAX_JOBS = 20;

  protected function renderFiles(Traversable<string> $files): Vector<string> {
    Log::i("\nRendering markdown to HTML");
    $jobs = dict[];

    foreach ($files as $input) {
      $output = self::getOutputFileName($input);
      $jobs[$input] = $output;
    }


    Log::v(' [fbgfm] ');
    $files = $this->renderFilesWithFBMarkdown($jobs);

    return new Vector($files);
  }

  protected function renderFilesWithFBMarkdown(
    dict<string, string> $files,
  ): vec<string> {
    $renderer = new MarkdownRenderer();
    foreach ($files as $in => $out) {
      $md = \file_get_contents($in);
      $html = $renderer->renderMarkdownToHTML($in, $md);
      \file_put_contents(
        $out,
        '<!-- fbgfm -->'.
        '<script>hljs.initHighlightingOnLoad();</script>'.
        $html,
      );
      Log::v('.');
    }
    return vec($files);
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

  public static function getOutputFileName(string $input): string {
    $input = str_replace(static::SOURCE_ROOT.'/', '', $input);
    $parts = (new Vector(explode('/', $input)))
      ->map(
        $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
      );

    $output = implode('/', $parts);

    $dir = dirname($output);
    $output =
      static::BUILD_ROOT.'/'.
      ($dir === '.' ? '' : $dir.'/').
      basename($output, '.md').
      '.html';

    $output_dir = dirname($output);
    if (!is_dir($output_dir)) {
      mkdir($output_dir, /* mode = */ 0755, /* recursive = */ true);
    }

    return $output;
  }
}
