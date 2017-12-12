<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace Facebook\Markdown;

require_once(__DIR__.'/../vendor/hh_autoload.php');

function cli_gfm_render(string $in): string {
  // Spec-compliance requires enabling HTML
  $parser_ctx = (new ParserContext())->enableHTML_UNSAFE();
  $ast = parse($parser_ctx, $in);
  if ((bool) \getenv('FB_GFM_DUMP_AST')) {
    var_dump($ast);
  }
  $render_ctx = new RenderContext();
  return (new HTMLRenderer($render_ctx))->render($ast);
}

print(cli_gfm_render(\file_get_contents('/dev/stdin')));
