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

use namespace HH\Lib\{C, Str, Vec};

final class Lines {
  public function __construct(
    private vec<(int, string)> $lines,
  ) {
  }

  public function isEmpty(): bool {
    return C\is_empty($this->lines);
  }

  public function getCount(): int {
    return C\count($this->lines);
  }

  public function getColumn(): int {
    return C\firstx($this->lines)[0];
  }

  public function getFirstLine(): string {
    return C\firstx($this->lines)[1];
  }

  public function getFirstLineAndRest(): (string, Lines) {
    return tuple(
      $this->getFirstLine(),
      new self(Vec\drop($this->lines, 1)),
    );
  }

  public function getColumnFirstLineAndRest(): (int, string, Lines) {
    return tuple(
      $this->getColumn(),
      $this->getFirstLine(),
      new self(Vec\drop($this->lines, 1)),
    );
  }

  public static function isBlankLine(string $line): bool {
    return Str\trim($line, " \t") === '';
  }

  public static function stripNLeadingWhitespace(
    string $line,
    int $n,
    int $column,
  ): ?string {
    list($_, $result, $stripped) = self::stripUpToNLeadingWhitespace(
      $line,
      $n,
      $column,
    );
    return ($stripped === $n) ? $result : null;
  }

  public function getRawData(): vec<(int, string)> {
    return $this->lines;
  }

  public static function stripUpToNLeadingWhitespace(
    string $line,
    int $n,
    int $column,
  ): (string, string, int) {
    $count = 0;
    $len = Str\length($line);
    for ($i = 0; $i < $len && $count < $n; ++$i) {
      $char = $line[$i];
      if ($char === ' ') {
        ++$count;
        continue;
      }
      if ($char === "\t") {
        $tab_width = 4 - (($column + $count) % 4);
        if ($tab_width === 0) {
          $tab_width = 4;
        }
        $count += $tab_width;
        continue;
      }
      break;
    }
    if ($count >= $n) {
      return tuple(
        Str\slice($line, 0, $i),
        Str\repeat(' ', $count - $n).Str\slice($line, $i),
        $n,
      );
    }

    return tuple(
      Str\slice($line, 0, $i),
      Str\slice($line, $i),
      $count,
    );
  }

  public function withLeftTrimmedFirstLine(): Lines {
    list($col, $line) = $this->lines[0];

    $len = Str\length($line);
    for ($i = 0; $i < $len; ++$i) {
      $char = $line[$i];
      if ($char !== ' ' && $char !== "\t") {
        break;
      }
    }

    if ($i === 0) {
      return $this;
    }

    return new self(
      Vec\concat(
        vec[tuple($col + $i , Str\slice($line, $i))],
        Vec\drop($this->lines, 1),
      ),
    );
  }

  public function withoutFirstLinePrefix(
    string $prefix,
  ): Lines {
    list($offset, $line) = C\firstx($this->lines);
    $len = Str\length($prefix);
    invariant(
      Str\slice($line, 0, $len) === $prefix,
      'Line does not start with prefix',
    );
    return new self(
      Vec\concat(
        vec[tuple($offset + $len, Str\slice($line, $len))],
        Vec\drop($this->lines, 1),
      ),
    );
  }

  public function withoutFirstNBytes(
    int $count,
  ): Lines {
    $lines = $this->lines;
    while ($count > 0) {
      list($offset, $line) = C\firstx($lines);

      $len = Str\length($line);
      if ($count > $len) {
        $count -= $len + 1; // +1 for "\n"
        $lines = Vec\drop($lines, 1);
        continue;
      }
      if ($count === $len) {
        $lines = Vec\concat(
          vec[tuple($offset + $count, '')],
          Vec\drop($lines, 1),
        );
        break;
      }
      if ($count <= $len) {
        $lines = Vec\concat(
          vec[tuple($offset + $count, Str\slice($line, $count))],
          Vec\drop($lines, 1),
        );
        break;
      }
    }
    return new self($lines);
  }

  public function toString(): string {
    return $this->lines
      |> Vec\map($$, $indent_and_line ==> $indent_and_line[1])
      |> Str\join($$, "\n");
  }
}
