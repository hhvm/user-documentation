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

use namespace HH\Lib\{C, Keyset, Str, Vec};

class Context {
  const keyset<classname<BlockProducer>> ALL_BLOCK_TYPES = keyset[
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

  private keyset<classname<BlockProducer>> $blockTypes;
  private keyset<classname<BlockProducer>> $disabledBlockTypes = keyset[];

  public function __construct() {
    $this->blockTypes = self::ALL_BLOCK_TYPES;
  }

  public function resetFileData(): this {
    $this->file = null;
    $this->linkReferenceDefinitions = dict[];
    $this->stacks = dict[];
    return $this;
  }

  public function disableExtensions(): this {
    $this->disabledBlockTypes = $this->blockTypes
      |> Keyset\filter($$, $class ==> Str\ends_with($class, 'Extension'))
      |> Keyset\union($$, $this->disabledBlockTypes);
    return $this;
  }

  public function enableNamedExtension(string $name): this {
    $this->disabledBlockTypes = Keyset\filter(
      $this->disabledBlockTypes,
      $class ==> !Str\ends_with(
        Str\lowercase($class),
        "\\".$name.'extension',
      ),
    );
    return $this;
  }

  public function prependBlockTypes(classname<BlockProducer> ...$blocks): this {
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
    if (!C\contains_key($this->linkReferenceDefinitions, $def->getKey())) {
      $this->linkReferenceDefinitions[$def->getKey()] = $def;
    }
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

  public function getBlockTypes(): keyset<classname<BlockProducer>> {
    return Keyset\filter(
      $this->blockTypes,
      $type ==> !C\contains($this->disabledBlockTypes, $type),
    );
  }

  private dict<string, vec<mixed>> $stacks = dict[];

  public function pushContext(string $context, mixed $value): this {
    $stack = $this->stacks[$context] ?? vec[];
    $stack[] = $value;
    $this->stacks[$context] = $stack;
    return $this;
  }

  public function popContext(string $context): this {
    $stack = $this->stacks[$context] ?? vec[];
    $count = C\count($stack) - 1;
    invariant($count >= 0, "Trying to pop more than was pushed");
    $stack = Vec\take($stack, $count);
    $this->stacks[$context] = $stack;
    return $this;
  }

  public function getContext(string $context): mixed{
    $stack = $this->stacks[$context] ?? vec[];
    return C\last($stack);
  }

  const string PARAGRAPH_CONTINUATION_FLAG = 'paragraph continuation';

  public function isInParagraphContinuation(): bool {
    return (bool) $this->getContext(self::PARAGRAPH_CONTINUATION_FLAG);
  }

  public function pushParagraphContinuation(bool $value): this {
    return $this->pushContext(self::PARAGRAPH_CONTINUATION_FLAG, $value);
  }

  public function popParagraphContinuation(): this {
    return $this->popContext(self::PARAGRAPH_CONTINUATION_FLAG);
  }

  public function getListItemTypes(): keyset<classname<ListItem>> {
    // TaskListItemExtension will also return normal ListItems; if we support
    // removing extensions, this will need to change.
    return keyset[TaskListItemExtension::class];
  }
}
