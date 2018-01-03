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

use type Facebook\Markdown\Blocks\ListItem as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str, Vec};

class ListItem extends ContainerBlock<Block> implements BlockProducer {
  const string MAX_INDENT_CONTEXT = 'list item max indent';

  public function __construct(
    protected int $indentation,
    protected string $delimiter,
    protected ?int $number,
    vec<Block> $children,
  ) {
    parent::__construct($children);
  }

  public function getIndentation(): int {
    return $this->indentation;
  }

  public function isOrderedList(): bool {
    return $this->number !== null;
  }

  public function getDelimiter(): string {
    return $this->delimiter;
  }

  public function getNumber(): ?int {
    return $this->number;
  }

  public function makesListLoose(): bool {
    return C\any($this->children, $child ==> $child instanceof BlankLine);
  }

  public static function consume(
    Context $context,
    Lines $lines,
  ): ?(ListItem, Lines) {
    $max_indent = $context->getContext(self::MAX_INDENT_CONTEXT);
    invariant(
      \is_int($max_indent),
      'expected to get a maximum indentation from context, got a %s',
      gettype($max_indent),
    );

    // Consume leading whitespace
    list($column, $line, $lines) = $lines->getColumnFirstLineAndRest();
    list($_, $line, $n) = Lines::stripUpToNLeadingWhitespace(
      $line,
      $max_indent,
      $column,
    );
    $matches = [];
    if (
      \preg_match(
        '/^(?<marker>[-+*]|(?<digits>[0-9]{1,9})[.)])/',
        $line,
        $matches,
      ) !== 1
    ) {
      return null;
    }

    // Consume marker
    $marker_length = Str\length($matches[0]);
    $indent_cols = $n + $marker_length;
    $column += $indent_cols;
    $line = Str\slice($line, $marker_length);

    // Consume post-marker whitespace
    if (Lines::isBlankLine($line)) {
      $line = null;
      $n = 1;
    } else if (Lines::stripNLeadingWhitespace($line, 5, $column) !== null) {
      // `-     foo` is `<li><pre><code>foo</pre></code></li>`
      list($_, $line, $n) =
        Lines::stripUpToNLeadingWhitespace($line, 1, $column);
    } else {
      list($_, $line, $n) =
        Lines::stripUpToNLeadingWhitespace($line, 4, $column);
    }
    if ($n === 0) {
      return null;
    }

    $indent_cols += $n;
    $column += $n;

    $ordered = ($matches['digits'] ?? '') !== '';
    $number = $ordered ? ((int) $matches['digits']) : null;
    $delimiter = Str\trim_left($matches['marker'], '0123456789');

    $matched = vec[];
    if ($line !== null) {
      $matched[] = tuple($column, $line);
    }
    $pre_blank_line = null;

    while (!$lines->isEmpty()) {
      list($column, $line, $rest) = $lines->getColumnFirstLineAndRest();
      if (Lines::isBlankLine($line)) {
        if (C\is_empty($matched)) {
          break;
        }
        if ($pre_blank_line === null) {
          $pre_blank_line = tuple($matched, $lines);
        }

        $matched[] = tuple($column, $line);
        $lines = $rest;
        continue;
      }

      $indented = Lines::stripNLeadingWhitespace($line, $indent_cols, $column);
      if ($indented !== null) {
        $matched[] = tuple($column + $indent_cols, $indented);
        $pre_blank_line = null;
        $lines = $rest;
        continue;
      }

      $maybe_thematic_break = ThematicBreak::consume($context, $lines);
      if ($maybe_thematic_break !== null) {
        break;
      }

      if ($pre_blank_line !== null) {
        break;
      }

      if (C\is_empty($matched)) {
        break;
      }

      // Laziness - explicitly check for a list item as empty list items are
      // valid paragraph continuation text
      try {
        $context->pushContext(self::MAX_INDENT_CONTEXT, $indent_cols - 1);
        if (ListItem::consume($context, $lines) !== null) {
          break;
        }
      } finally {
        $context->popContext(self::MAX_INDENT_CONTEXT);
      }

      if (!_Private\is_paragraph_continuation_text($context, $lines)) {
        break;
      }

      $matched[] = tuple($column, $line);
      $lines = $rest;
    }

    if (C\is_empty($matched) && $context->isInParagraphContinuation()) {
      return null;
    }

    if ($pre_blank_line !== null) {
      list($matched, $lines) = $pre_blank_line;
    }

    return tuple(
      static::createFromContents(
        $context,
        $indent_cols,
        $delimiter,
        $number,
        new Lines($matched),
      ),
      $lines,
    );
  }

  protected static function createFromContents(
    Context $context,
    int $indent_cols,
    string $delimiter,
    ?int $number,
    Lines $contents,
  ): ListItem {
    return new self(
      $indent_cols,
      $delimiter,
      $number,
      self::consumeChildren($context, $contents),
    );
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    return new ASTNode(
      $this->number,
      Vec\map($this->children, $child ==> $child->withParsedInlines($ctx)),
    );
  }
}
