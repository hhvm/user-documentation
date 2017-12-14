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
use namespace HH\Lib\Str;

/**
 * Re-format code blocks to be rendered nicely.
 *
 * 1. wrap in <div class="highlight">
 * 2. change language from Hack to PHP for now.
 */
final class PrettyCodeBlocksFilter extends RenderFilter {
  <<__Override>>
  public function filter(
    RenderContext $_,
    ASTNode $node,
  ): vec<ASTNode> {
    if (!$node instanceof Blocks\CodeBlock) {
      return vec[$node];
    }
    if ($node instanceof PrettyCodeBlock) {
      return vec[$node];
    }

    $info_string = $node->getInfoString();
    if ($info_string !== null && Str\lowercase($info_string) === 'hack') {
      $info_string = 'PHP';
    }

    return vec[
      new Blocks\HTMLBlock('<div class="highlight">'),
      new PrettyCodeBlock($info_string, $node->getCode()),
      new Blocks\HTMLBlock('</div>'),
    ];
  }
}
