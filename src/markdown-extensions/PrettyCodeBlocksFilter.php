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

namespace HHVM\UserDocumentation\MarkdownExt;

use type Facebook\Markdown\{ASTNode, RenderContext, RenderFilter};
use namespace Facebook\Markdown\Blocks;
use namespace HH\Lib\{Str, Vec};

/**
 * Re-format code blocks to be rendered nicely.
 *
 * 1. wrap in <div class="highlight">
 * 2. change language from Hack to PHP for now.
 */
final class PrettyCodeBlocksFilter extends RenderFilter {
  <<__Override>>
  public function filter(RenderContext $_, ASTNode $node): vec<ASTNode> {
    if (!$node is Blocks\CodeBlock) {
      return vec[$node];
    }
    if ($node is PrettyCodeBlock) {
      return vec[$node];
    }

    $info_string = $node->getInfoString();
    $classes = 'highlight fbgfm';
    $code = $node->getCode();
    if ($info_string !== null && Str\starts_with_ci($info_string, 'hack')) {
      if (Str\lowercase($info_string) === 'hacksignature') {
        $code = Str\split($code, "\n") |> Vec\drop($$, 1) |> Str\join($$, "\n");
      }

      $classes .= ' source-language-'.$info_string;
      $info_string = 'PHP';
    } else {
      $classes .= ' output-block';
    }

    return vec[
      new Blocks\HTMLBlock('<div class="'.$classes.'">'),
      new PrettyCodeBlock($info_string, $code),
      new Blocks\HTMLBlock('</div>'),
    ];
  }
}
