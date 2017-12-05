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

namespace Facebook\Markdown\UnparsedBlocks;

use type Facebook\Markdown\Blocks\BlockQuote as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

final class BlockQuote extends ContainerBlock {
  public function __construct(
    private vec<Block> $children,
  ) {
  }

  public static function consume(
    Context $context,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    $line = C\firstx($lines);
    if (\preg_match('/^ {0,3}>/', $line) !== 1) {
      return null;
    }

    // Figure out what goes in this block first
    $matched = vec[];
    for ($idx = 0; $idx < C\count($lines); ++$idx) {
      $line = $lines[$idx];
      if ($line === '') {
        break;
      }

      $matches = [];
      \preg_match('/^(?<marker> {0,3}> ?)(?<content>.*)$/', $line, $matches);
      if ($matches['marker'] ?? '' !== '') {
        $matched[] = $matches['content'];
        continue;
      }

      if (_Private\is_paragraph_continuation_text($context, Vec\drop($lines, $idx))) {
        $matched[] = $line;
      }
    }
    $rest = Vec\drop($lines, C\count($matched));
    return tuple(new self(self::consumeChildren($context, $matched)), $rest);
  }

  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    return new ASTNode(
      Vec\map(
        $this->children,
        $child ==> $child->withParsedInlines($ctx),
      ),
    );
  }
}
