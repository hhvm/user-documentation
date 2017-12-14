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

namespace Facebook\Markdown;

use namespace HH\Lib\Str;

class TagFilterExtension extends RenderFilter {
  public function filter(
    RenderContext $context,
    ASTNode $node,
  ): vec<ASTNode> {
    if ($node instanceof Blocks\HTMLBlock) {
      return vec[$this->filterHTMLBlock($node)];
    }
    if ($node instanceof Inlines\RawHTML) {
      return vec[$this->filterInlineHTML($node)];
    }
    return vec[$node];
  }

  protected function filterHTMLBlock(
    Blocks\HTMLBlock $block,
  ): Blocks\HTMLBlock {
    return new Blocks\HTMLBlock($this->filterHTML($block->getCode()));
  }

  protected function filterInlineHTML(
    Inlines\RawHTML $inline,
  ): Inlines\RawHTML {
    return new Inlines\RawHTML($this->filterHTML($inline->getContent()));
  }

  const keyset<string> BLACKLIST = keyset[
    '<title',
    '<textarea',
    '<style',
    '<xmp',
    '<iframe',
    '<noembed',
    '<noframes',
    '<script',
    '<plaintext',
  ];

  protected function filterHTML(string $code): string {
    foreach (static::BLACKLIST as $tag) {
      $offset = 0;
      while (true) {
        $offset = Str\search_ci($code, $tag, $offset);
        if ($offset === null) {
          break;
        }

        $code =
          Str\slice($code, 0, $offset).
          '&lt;'.
          Str\slice($code, $offset + 1);
        $offset += 3; // len('&lt;') - len('<')
      }
    }
    return $code;
  }
}
