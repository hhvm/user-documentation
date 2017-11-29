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

namespace Facebook\GFM\BlockParsing;

use namespace HH\Lib\C;

abstract class Block extends Node {
  const vec<classname<Block>> PRIORITIZED_BLOCK_TYPES = vec[
    BlankLine::class,
    ATXHeading::class,
    FencedCodeBlock::class,
    HTMLBlock::class,
    IndentedCodeBlock::class,
    LinkReferenceDefinition::class,
    BlockQuote::class,
    ListOfItems::class,
    ThematicBreak::class,
    SetextHeading::class,
    Paragraph::class,
  ];

  public abstract static function consume(
    vec<string> $lines,
  ): ?(Node, vec<string>);

  protected static function isParagraphContinuationText(
    vec<string> $lines,
  ): bool {
    return !C\any(
      Block::PRIORITIZED_BLOCK_TYPES,
      (classname<Block> $block) ==>
        $block !== Paragraph::class &&
        $block !== SetextHeading::class &&
        $block::consume($lines) !== null
    );
  }
}
