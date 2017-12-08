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

class BlockQuote extends ContainerBlock<?(BlockQuote, Lines), Block> {
  protected static function consumeImpl(
    Context $context,
    Lines $lines,
  ): ?(BlockQuote, Lines) {
    $contents = vec[];
    while (!$lines->isEmpty()) {
      list($col, $line, $rest) = $lines->getColumnFirstLineAndRest();

      $matches = [];
      if (\preg_match('/^ {0,3}>([ \t])?/', $line, $matches) === 1) {
        $prefix = $matches[0];
        $len = Str\length($prefix);
        $match = Str\slice($line, $len);
        if (Str\ends_with($prefix, "\t")) {
          $spaces = 3 - (($col + $len - 1) % 4);
          $match = Str\repeat(' ', $spaces).$match;
        }
        $contents[] = tuple($col + $len, $match);
        $lines = $rest;
        continue;
      }

      if (C\is_empty($contents)) {
        return null;
      }

      if (_Private\is_paragraph_continuation_text($context, $lines)) {
        $contents[] = tuple($col, $line);
        $lines = $rest;
        continue;
      }

      break;
    }

    if (C\is_empty($contents)) {
      return null;
    }
    $contents = new Lines($contents);

    return tuple(new self(self::consumeChildren($context, $contents)), $lines);
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
