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

final class SyntaxHighlightCSSBuildStep extends BuildStep {
  const string PROVIDER = LocalConfig::ROOT.'/md-render/syntax-highlight-css.rb';

  public function buildAll(): void {
    Log::i("\nSyntaxHighlightCSS");
    $css = null;
    $exit_code = null;
    exec(self::PROVIDER, /* & */ $css, /* & */ $exit_code);
    invariant(
      $exit_code === 0,
      'Failed to get CSS for syntax highlighting'
    );

    file_put_contents(
      BuildPaths::SYNTAX_HIGHLIGHT_CSS,
      $css,
    );
  }
}
