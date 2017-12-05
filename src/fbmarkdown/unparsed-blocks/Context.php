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

use namespace HH\Lib\Keyset;

class Context {
  const keyset<classname<Block>> ALL_BLOCK_TYPES = keyset[
    TableExtension::class,
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

  private keyset<classname<Block>> $blockTypes;

  public function __construct() {
    $this->blockTypes = self::ALL_BLOCK_TYPES;
  }

  public function resetFileData(): this {
    $this->file = null;
    return $this;
  }

  public function prependBlockTypes(classname<Block> ...$blocks): this {
    $this->blockTypes = Keyset\union($blocks, $this->blockTypes);
    return $this;
  }

  private ?string $file;

  public function setFilePath(string $file): this {
    $this->file = $file;
    return $this;
  }

  public function getFilePath(): ?string {
    return $this->file;
  }

  private bool $isHtmlEnabled = false;

  public function enableHTML_UNSAFE(): this {
    $this->isHtmlEnabled = true;
    return $this;
  }

  public function isHTMLEnabled(): bool {
    return $this->isHtmlEnabled;
  }

  public function getBlockTypes(): keyset<classname<Block>> {
    return $this->blockTypes;
  }

  public function getIgnoredBlockTypesForParagraphContinuation(
  ): keyset<classname<Block>> {
    return keyset[
      HTMLBlock::class,
      Paragraph::class,
      SetextHeading::class,
    ];
  }
}
