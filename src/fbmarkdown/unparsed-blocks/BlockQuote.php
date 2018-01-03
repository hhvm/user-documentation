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

class BlockQuote extends ContainerBlock<Block> implements BlockProducer {
  public static function consume(
    Context $context,
    Lines $lines,
  ): ?(BlockQuote, Lines) {
    $contents = vec[];
    $parsed = null;

    while (!$lines->isEmpty()) {
      $chunk = self::consumePrefixedChunk($context, $lines);
      if ($chunk === null) {
        break;
      }

      list($chunk, $lines) = $chunk;
      $contents = Vec\concat($contents, $chunk);
      $parsed = self::consumeChildren($context, new Lines($contents));

      if (!self::endsWithParagraph(C\lastx($parsed))) {
        break;
      }

      $chunk = self::consumeLazyChunk($context, $lines);
      if ($chunk === null) {
        break;
      }

      list($chunk, $lines) = $chunk;
      $contents = Vec\concat($contents, $chunk);
      $parsed = null;
    }


    if (C\is_empty($contents)) {
      return null;
    }

    if ($parsed === null) {
      $parsed = self::consumeChildren($context, new Lines($contents));
    }

    return tuple(new self($parsed), $lines);
  }

  protected static function endsWithParagraph(
    Block $block,
  ): bool {
    if ($block instanceof Paragraph) {
      return true;
    }
    if ($block instanceof ContainerBlock) {
      $last = C\lastx($block->getChildren());
      return self::endsWithParagraph($last);
    }
    return false;
  }

  protected static function consumeLazyChunk(
    Context $context,
    Lines $lines,
  ): ?(vec<(int, string)>, Lines) {
    $contents = vec[];
    while (!$lines->isEmpty()) {
      if (!_Private\is_paragraph_continuation_text($context, $lines)) {
        break;
      }
      list($col, $line, $lines) = $lines->getColumnFirstLineAndRest();
      $contents[] = tuple($col, $line);
    }

    if (C\is_empty($contents)) {
      return null;
    }

    return tuple($contents, $lines);
  }

  protected static function consumePrefixedChunk(
    Context $context,
    Lines $lines,
  ): ?(vec<(int, string)>, Lines) {
    $contents = vec[];
    while (!$lines->isEmpty()) {
      list($col, $line, $rest) = $lines->getColumnFirstLineAndRest();
      list($_, $line, $n) = Lines::stripUpToNLeadingWhitespace(
        $line,
        3,
        $col,
      );
      $col = $col + $n;

      $offset = null;
      if (Str\starts_with($line, '> ')) {
        $line = Str\slice($line, 2);
        $col += 2;
      } else if (Str\starts_with($line, ">\t")) {
        $col += 1; // >
        $tab_width = 4 - ($col % 4);
        $col += 1; // \t

        $line = Str\slice($line, 2);

        if ($tab_width === 0) {
          $tab_width = 4;
        }
        $line = Str\repeat(' ', $tab_width - 1).$line;
      } else if (Str\starts_with($line, '>')) {
        $line = Str\slice($line, 1);
        $col += 1;
      } else {
        break;
      }

      $contents[] = tuple($col, $line);
      $lines = $rest;
    }

    if (C\is_empty($contents)) {
      return null;
    }
    return tuple($contents, $lines);
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    return new ASTNode(
      Vec\map(
        $this->children,
        $child ==> $child->withParsedInlines($ctx),
      ),
    );
  }
}
