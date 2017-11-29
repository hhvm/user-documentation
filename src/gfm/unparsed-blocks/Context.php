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

namespace Facebook\GFM\UnparsedBlocks;

use namespace HH\Lib\Keyset;

final class Context {
  const keyset<classname<Block>> ALL_BLOCK_TYPES = keyset[
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

  private bool $isHtmlEnabled = false;

  public function enableHTML_UNSAFE(): this {
    $this->isHtmlEnabled = true;
    return $this;
  }

  public function getBlockTypes(): keyset<classname<Block>> {
    $types = self::ALL_BLOCK_TYPES;
    if (!$this->isHtmlEnabled) {
      unset($types[HTMLBlock::class]);
    }
    return $types;
  }

  public function getIgnoredBlockTypesForParagraphContinuation(
  ): keyset<classname<Block>> {
    return keyset[SetextHeading::class, Paragraph::class];
  }
}
