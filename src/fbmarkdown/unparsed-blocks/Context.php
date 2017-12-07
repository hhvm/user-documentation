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

use namespace HH\Lib\{Keyset, Vec};

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
    ThematicBreak::class,
    ListOfItems::class,
    SetextHeading::class,
    Paragraph::class,
  ];

  private keyset<classname<Block>> $blockTypes;

  public function __construct() {
    $this->blockTypes = self::ALL_BLOCK_TYPES;
  }

  public function resetFileData(): this {
    $this->file = null;
    $this->linkReferenceDefinitions = dict[];
    $this->paragraphDepth = 0;
    return $this;
  }

  public function prependBlockTypes(classname<Block> ...$blocks): this {
    $this->blockTypes = Keyset\union($blocks, $this->blockTypes);
    return $this;
  }

  private dict<string, LinkReferenceDefinition> $linkReferenceDefinitions
    = dict[];

  public function getLinkReferenceDefinition(
    string $key,
  ): ?LinkReferenceDefinition {
    $key = LinkReferenceDefinition::normalizeKey($key);
    return $this->linkReferenceDefinitions[$key] ?? null;
  }

  public function addLinkReferenceDefinition(
    LinkReferenceDefinition $def,
  ): this {
    $this->linkReferenceDefinitions[$def->getKey()] = $def;
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

  private int $paragraphDepth = 0;

  public function isInParagraphContinuation(): bool {
    return $this->paragraphDepth !== 0;
  }

  public function pushParagraphContinuation(): this {
    $this->paragraphDepth++;
    return $this;
  }

  public function popParagraphContinuation(): this {
    $this->paragraphDepth--;
    invariant(
      $this->paragraphDepth >= 0,
      "Can't have a negative paragraph continuation depth",
    );
    return $this;
  }

  public function getIgnoredBlockTypesForParagraphContinuation(
  ): keyset<classname<Block>> {
    return keyset[
      IndentedCodeBlock::class,
      Paragraph::class,
      SetextHeading::class,
    ];
  }

  public function getListItemTypes(): keyset<classname<ListItem>> {
    // TaskListItemExtension will also return normal ListItems; if we support
    // removing extensions, this will need to change.
    return keyset[TaskListItemExtension::class];
  }
}
