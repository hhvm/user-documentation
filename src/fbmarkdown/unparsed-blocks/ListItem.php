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
    vec<string> $lines,
  ): ?(ListItem, vec<string>) {
    $line = C\firstx($lines);
    $matches = [];
    if (
      \preg_match(
        '/^ {0,3}(?<marker>[-+*]|(?<digits>[0-9]{1,9})[.)]) {1,4}/',
        $line,
        $matches,
      ) !== 1
    ) {
      return null;
    }
    $full = $matches[0];
    $width = Str\length($full);
    $prefix = Str\repeat(' ', $width);
    $ordered = ($matches['digits'] ?? null) !== null;
    $number = $ordered ? ((int) $matches['digits']) : null;
    $delimiter = Str\trim_left($matches['marker'], '0123456789');

    $matched = vec[Str\strip_prefix($line, $full)];

    $last_blank = false;
    for ($idx = 1; $idx < C\count($lines); ++$idx) {
      $line = $lines[$idx];
      if ($line === '') {
        if ($last_blank) {
          $matched = Vec\take($matched, C\count($matched) - 1);
          break;
        }
        $matched[] = $line;
        $last_blank = true;
        continue;
      }
      $maybe_thematic_break = ThematicBreak::consume($context, vec[$line]);
      if ($maybe_thematic_break !== null) {
        break;
      }

      if (Str\starts_with($line, $prefix)) {
        $matched[] = Str\strip_prefix($line, $prefix);
        continue;
      }

      if ($last_blank) {
        break;
      }
      $last_blank = false;


      // Laziness
      $line = Str\trim_left($line);
      if (!_Private\is_paragraph_continuation_text($context, vec[$line])) {
        break;
      }

      $matched[] = $line;
    }

    if (C\lastx($matched) === '') {
      $matched = Vec\take($matched, C\count($matched) - 1);
    }
    $rest = Vec\drop($lines, C\count($matched));

    return tuple(
      static::createFromContents($context, $delimiter, $number, $matched),
      $rest,
    );
  }

  protected static function createFromContents(
    Context $context,
    string $delimiter,
    ?int $number,
    vec<string> $contents,
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
