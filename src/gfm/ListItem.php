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

use namespace HH\Lib\{C, Str, Vec};

final class ListItem extends ContainerBlock {
  public function __construct(
    private string $delimiter,
    private ?int $number,
    private vec<Node> $children,
  ) {
  }

  public function isOrderedList(): bool {
    return $this->number !== null;
  }

  public function getDelimiter(): string {
    return $this->delimiter;
  }

  public static function consume(vec<string> $lines): ?(ListItem, vec<string>) {
    $line = C\firstx($lines);
    $matches = [];
    if (
      \preg_match(
        '/^(?<full>(?<marker>[-+*]|(?<digits>[0-9]{1,9})[.)]) {1,4})/',
        $line,
        $matches,
      ) !== 1
    ) {
      return null;
    }
    $width = Str\length($matches['full']);
    $prefix = Str\repeat(' ', $width);
    $ordered = ($matches['digits'] ?? null) !== null;
    $number = $ordered ? ((int) $matches['digits']) : null;
    $delimiter = Str\trim_left($matches['marker'], '0123456789');

    $matched = vec[Str\strip_prefix($line, $matches['full'])];

    $last_blank = false;
    for ($idx = 1; $idx < C\count($lines); ++$idx) {
      $line = $lines[$idx];
      if ($line === '') {
        if ($last_blank) {
          $matched = Vec\take($matched, $idx);
          break;
        }
        $matched[] = $line;
        $last_blank = true;
        continue;
      }
      $last_blank = false;

      $maybe_thematic_break = ThematicBreak::consume(Vec\drop($lines, $idx));
      if ($maybe_thematic_break !== null) {
        break;
      }

      if (Str\starts_with($line, $prefix)) {
        $matched[] = Str\strip_prefix($line, $prefix);
        continue;
      }

      // Laziness
      $line = Str\trim_left($line);
      if (!self::isParagraphContinuationText(
        Vec\concat(
          vec[$line],
          Vec\drop($lines, $idx + 1),
        ),
      )) {
        break;
      }

      $matched[] = $line;
    }

    $rest = Vec\drop($lines, C\count($matched));
    return tuple(
      new self($delimiter, null, self::consumeChildren($matched)),
      $rest,
    );
  }
}
