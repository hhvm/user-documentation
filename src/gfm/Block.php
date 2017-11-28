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

namespace Facebook\GFM;

abstract class Block extends Node {
  const vec<classname<Block>> PRIORITIZED_BLOCK_TYPES = vec[
    BlankLine::class,
    ATXHeading::class,
    FencedCodeBlock::class,
    HTMLBlock::class,
    IndentedCodeBlock::class,
    LinkReferenceDefinition::class,
    ThematicBreak::class,
    SetextHeading::class,
    Paragraph::class,
  ];

  public abstract static function consume(
    vec<string> $lines,
  ): ?(Node, vec<string>);
}
