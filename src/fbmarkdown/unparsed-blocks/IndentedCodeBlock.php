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

use type Facebook\Markdown\Blocks\IndentedCodeBlock as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

class IndentedCodeBlock extends LeafBlock implements BlockProducer {
  public function __construct(private string $content) {
  }

  public static function consume(
    Context $context,
    Lines $lines,
  ): ?(Block, Lines) {
    if ($context->isInParagraphContinuation()) {
      return null;
    }

    $matched = vec[];
    $blank_line_stash = null;
    while (!$lines->isEmpty()) {
      list($col, $line, $rest) = $lines->getColumnFirstLineAndRest();
      $stripped = Lines::stripNLeadingWhitespace($line, 4, $col);
      if ($stripped !== null && $stripped !== '') {
        $blank_line_stash = null;
        $matched[] = $stripped;
        $lines = $rest;
        continue;
      }

      if (!Lines::isBlankLine($line)) {
        break;
      }

      if ($blank_line_stash === null) {
        $blank_line_stash = tuple($matched, $lines);
      }

      $matched[] = '';
      $lines = $rest;
    }

    if ($blank_line_stash !== null) {
      list($matched, $lines) = $blank_line_stash;
    }

    if (C\is_empty($matched)) {
      return null;
    }
    return tuple(new self(Str\join($matched, "\n")), $lines);
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $_): ASTNode {
    return new ASTNode(/* info string = */ null, $this->content);
  }
}
