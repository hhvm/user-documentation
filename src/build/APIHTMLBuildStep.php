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

final class APIHTMLBuildStep extends AbstractMarkdownRenderBuildStep {
  const string SOURCE_ROOT = BuildPaths::APIDOCS_MARKDOWN;
  const string BUILD_ROOT = BuildPaths::APIDOCS_HTML;

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nAPIHTMLBuild");
    $sources = self::findSources(self::SOURCE_ROOT, Set{'md'})
      |> Vec\filter($$, $path ==> \basename($path) !== 'README.md')
      |> Vec\filter($$, $path ==> \strpos($path, '-examples') === false)
      |> Vec\sort($$);

    $this->renderFiles($sources);
  }
}
