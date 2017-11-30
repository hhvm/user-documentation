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

use type Facebook\GFM\Blocks\LinkReferenceDefinition as ASTNode;
use function Facebook\GFM\_Private\consume_link_destination;
use namespace Facebook\GFM\Inlines;
use namespace HH\Lib\{C, Str, Vec};

final class LinkReferenceDefinition extends LeafBlock {
  public function __construct(
    private string $label,
    private string $destination,
    private ?string $title,
  ) {
  }

  public static function consume(
    Context $_,
    vec<string> $lines,
  ): ?(Block, vec<string>) {
    $first = C\firstx($lines);
    $matches = [];
    if (
      \preg_match(
        '/^ {0,3}\[(?<label> *([^ \]]+ *)+)\]: *(?<rest>.*)$/',
        $first,
        $matches,
      ) !== 1
    ) {
      return null;
    }

    $label = $matches['label']
      |> Str\trim($$)
      |> \mb_convert_case($$, MB_CASE_LOWER, "UTF-8")
      |> \preg_replace('/\s+/', ' ', $$);

    $rest = $matches['rest'] ?? '';
    if ($rest !== '') {
      $lines = Vec\concat(
        vec[$rest],
        Vec\drop($lines, 1),
      );
    } else {
      $lines = Vec\drop($lines, 1);
    }

    $result = self::consumeDestination($lines);
    if ($result === null) {
      return null;
    }
    list($destination, $lines) = $result;

    $title = null;
    $result = self::consumeTitle($lines);
    if ($result !== null) {
      list($title, $lines) = $result;
    }

    return tuple(
      new self($label, $destination, $title),
      $lines,
    );
  }

  private static function consumeDestination(
    vec<string> $lines,
  ): ?(string, vec<string>) {
    $out = consume_link_destination(Str\join($lines, "\n"));
    if ($out === null) {
      return null;
    }
    list($destination, $rest) = $out;
    return tuple($destination, Str\split($rest, "\n"));
  }

  private static function consumeTitle(
    vec<string> $lines,
  ): ?(string, vec<string>) {
    $first = C\firstx($lines);
    if ($first === '') {
      return null;
    }
    $first_chr = $first[0];
    if ($first_chr === '"' || $first_chr === "'") {
      return self::consumeQuotedTitle($lines);
    }
    if ($first_chr === '(') {
      return self::consumeParenthesizedTitle($lines);
    }
    return null;
  }

  private static function consumeQuotedTitle(
    vec<string> $lines,
  ): ?(string, vec<string>) {
    $line_count = C\count($lines);
    $quote = C\firstx($lines)[0];
    invariant(
      $quote === "'" || $quote === '"',
      'Should not be called without a quote',
    );

    $title = '';
    $idx = null;
    $terminated = false;
    for ($line_idx = 0; $line_idx < $line_count; ++$line_idx) {
      $escaped = false;
      $line = $lines[$line_idx];
      if ($line === '') {
        return null;
      }
      $len = Str\length($line);
      for ($idx = 0; $idx < $len; ++$idx) {
        $chr = $line[$idx];
        if ($chr === $quote) {
          if ($escaped) {
            $title .= $chr;
            $escaped = false;
            continue;
          }
          $terminated = true;
          break;
        }

        if ($escaped) {
          $title .= '\\';
        } else if ($chr === '\\') {
          $escaped = true;
          continue;
        }
        $escaped = false;
        $title .= $chr;
      }
      if ($terminated) {
        break;
      }
    }

    if ($terminated === false) {
      return null;
    }

    invariant($idx !== null, "Shouldn't be invoked with no lines");
    invariant($line_idx !== $line_count, "Shouldn't reach EOF with match");

    $last_matched = $lines[$line_idx];
    $unmatched = Str\slice($last_matched, $idx + 1);
    if (Str\trim($unmatched) === '') {
      $lines = Vec\drop($lines, $line_idx + 1);
    } else {
      $lines = Vec\concat(
        vec[$unmatched],
        Vec\drop($lines, $line_idx + 1),
      );
    }

    return tuple($title, $lines);
  }

  private static function consumeParenthesizedTitle(
    vec<string> $lines,
  ): ?(string, vec<string>) {
    $line_count = C\count($lines);

    $title = '';
    $depth = 0;
    $idx = null;
    for ($line_idx = 0; $line_idx < $line_count; ++$line_idx) {
      $line = $lines[$line_idx];
      if ($line === '') {
        return null;
      }

      $escaped = false;
      $len = Str\length($line);
      for ($idx = 0; $idx < $len; ++$idx) {
        $chr = $line[$idx];
        if ($chr === '(') {
          if ($escaped) {
            $title .= $chr;
            $escaped = false;
            continue;
          }
          ++$depth;
          continue;
        }

        if ($chr === ')') {
          if ($escaped) {
            $title .= $chr;
            $escaped = false;
            continue;
          }
          --$depth;
          if ($depth === 0) {
            break;
          }
          continue;
        }

        if ($escaped) {
          $title .= '\\';
        } else if ($chr === '\\') {
          $escaped = true;
          continue;
        }
        $escaped = false;
        $title .= $chr;
      }
      if ($depth === 0) {
        break;
      }
    }

    if ($depth !== 0) {
      return null;
    }

    invariant($idx !== null, "Shouldn't be invoked with no lines");
    invariant($line_idx !== $line_count, "Shouldn't reach EOF with depth == 0");

    $last_matched = $lines[$line_idx];
    $unmatched = Str\slice($last_matched, $idx + 1);
    if (Str\trim($unmatched) === '') {
      $lines = Vec\drop($lines, $line_idx + 1);
    } else {
      $lines = Vec\concat(
        vec[$unmatched],
        Vec\drop($lines, $line_idx + 1),
      );
    }

    return tuple($title, $lines);
  }

  public function withParsedInlines(Inlines\Context $ctx): ASTNode {
    $title = $this->title;
    if ($title !== null) {
      $title = Inlines\Inline::parse($ctx, $title);
    } else {
      // No-op, but avoids null|string|vec<Inline> type
      $title = null;
    }
    return new ASTNode($this->label, $this->destination, $title);
  }
}
