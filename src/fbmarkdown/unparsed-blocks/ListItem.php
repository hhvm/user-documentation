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

class ListItem extends ContainerBlock {
  public function __construct(
    protected string $delimiter,
    protected ?int $number,
    protected vec<Block> $children,
  ) {
  }

  public function isOrderedList(): bool {
    return $this->number !== null;
  }

  public function getDelimiter(): string {
    return $this->delimiter;
  }

  final public static function consume(
    Context $context,
    Lines $lines,
  ): ?(ListItem, Lines) {
    list($column, $line, $rest) = $lines->getColumnFirstLineAndRest();
    $matches = [];
    if (
      \preg_match(
        '/^ {0,3}(?<marker>[-+*]|(?<digits>[0-9]{1,9})[.)])( {1,4}|\t)/',
        $line,
        $matches,
      ) !== 1
    ) {
      return null;
    }
    $prefix = $matches[0];
    $width = Str\length($prefix);
    $rest_of_line = Str\slice($line, $width);

    if (Str\ends_with($prefix, "\t")) {
      $tab_width = 4 - (($width + $column - 1) % 4);
      if ($tab_width === 0) {
        $tab_width = 4;
      }
      $rest_of_line = Str\repeat(' ', $tab_width - 1).$rest_of_line;
    }

    $ordered = $matches['digits'] !== '';
    $number = $ordered ? ((int) $matches['digits']) : null;
    $delimiter = Str\trim_left($matches['marker'], '0123456789');

    $matched = vec[
      tuple($column + $width, $rest_of_line),
    ];
    $last_blank = false;

    $lines = $rest;
    while (!$lines->isEmpty()) {
      list($column, $line, $rest) = $lines->getColumnFirstLineAndRest();
      if (self::isBlankLine($line)) {
        if ($last_blank) {
          $matched = Vec\take($matched, C\count($matched) - 1);
          break;
        }
        $matched[] = tuple($column, $line);
        $lines = $rest;
        $last_blank = true;
        continue;
      }
      $maybe_thematic_break = ThematicBreak::consume($context, $lines);
      if ($maybe_thematic_break !== null) {
        break;
      }

      $indented = Lines::stripWhitespacePrefix($line, $width, $column);
      if ($indented !== null) {
        $matched[] = tuple($column + $width, $indented);
        $last_blank = false;
        $lines = $rest;
        continue;
      }

      if ($last_blank) {
        break;
      }
      $last_blank = false;

      // Laziness
      if (!_Private\is_paragraph_continuation_text($context, $lines)) {
        break;
      }

      $matched[] = tuple($column, $line);
      $lines = $rest;
    }

    if (C\lastx($matched)[1] === '') {
      $matched = Vec\take($matched, C\count($matched) - 1);
    }

    return tuple(
      static::createFromContents(
        $context,
        $delimiter,
        $number,
        new Lines($matched),
      ),
      $rest,
    );
  }

  protected static function createFromContents(
    Context $context,
    string $delimiter,
    ?int $number,
    Lines $contents,
  ): ListItem {
    return new self(
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
