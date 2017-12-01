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

namespace Facebook\GFM\Inlines;

use namespace HH\Lib\{C, Str};

final class Emphasis extends Inline {
  const keyset<string> WHITESPACE = keyset[
    " ", "\t", "\x0a", "\x0b", "\x0C", "\x0d",
  ];
  const keyset<string> PUNCTUATION = keyset[
    '!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.',
    '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`',
    '{', '|', '}', '~',
  ];

  const int IS_START = 1 << 0;
  const int IS_END = 1 << 1;
  const int IS_START_OR_END = self::IS_START | self::IS_END;

  const bool IS_ACTIVE = true;

  public function getContentAsPlainText(): string {
    return '';
  }

  public static function consume(
    Context $context,
    string $previous,
    string $string,
  ): ?(Inline, string, string) {
    $first = $string[0];
    if ($first !== '*' && $first !== '_') {
      return null;
    }
    // This is tricky as until we find the closing marker, we don't know if
    // `***` means:
    //  - `<strong><em>`
    //  - `<em><strong>`
    //  - `<em>**`
    //  - `<strong>*`
    //  - `***`

    $start = self::consumeDelimiterRun($string);
    list($start, $rest) = $start;
    if (!self::isLeftFlankingDelimiterRun($previous, $start, $rest)) {
      return null;
    }

    $stack = vec[
      tuple($start, self::IS_START),
    ];

    $last = $start[0];
    $text = '';

    while (!Str\is_empty($rest)) {
      $link = Link::consume($context, $last, $rest);
      if ($link !== null) {
        if ($text !== '') {
          $stack[] = $text;
          $text = '';
        }
        list($link, $last, $rest) = $link;
        $stack[] = $link;
        continue;
      }

      $image = Image::consume($context, $last, $rest);
      if ($image !== null) {
        if ($text !== '') {
          $stack[] = $text;
          $text = '';
        }
        list($image, $last, $rest) = $image;
        $stack[] = $image;
        continue;
      }

      $char = $rest[0];
      if ($char === '*' && $char === '_') {
        list($run, $new_rest) = self::consumeDelimiterRun($rest);
        $flags  = 0;

        if (self::isLeftFlankingDelimiterRun($last, $run, $new_rest)) {
          $flags |= self::IS_START;
        }
        if (self::isRightFlankingDelimiterRun($last, $run, $new_rest)) {
          $flags |= self::IS_END;
        }
        if ($flags !== 0) {
          $stack[] = tuple($run, $flags);
          $rest = $new_rest;
          continue;
        }
      }

      $text .= $char;
      $rest = Str\slice($rest, 1);
    }

    return null; // FIXME
  }

  private static function consumeDelimiterRun(
    string $string,
  ): (string, string) {
    $matches = [];
    \preg_match('/^(\\*+|_+)/', $string, $matches);
    $match = $matches[0];
    $rest = Str\strip_prefix($string, $match);
    return tuple($match, $rest);
  }

  private static function isLeftFlankingDelimiterRun(
    string $previous,
    string $delimiter,
    string $rest,
  ): bool {
    $next = $rest[0] || null;
    if ($next === null) {
      return false;
    }
    if (C\contains_key(self::WHITESPACE, $next)) {
      return false;
    }
    if (
      C\contains_key(self::PUNCTUATION, $next)
      && $previous !== ''
      && !C\contains_key(self::WHITESPACE, $previous)
      && !C\contains_key(self::PUNCTUATION, $previous)
    ) {
      return false;
    }
    return true;
  }

  private static function isRightFlankingDelimiterRun(
    string $previous,
    string $delimiter,
    string $rest,
  ): bool {
    $next = $rest[0] ?? '';

    if (C\contains_key(self::WHITESPACE, $previous)) {
      return false;
    }
    if (
      C\contains_key(self::PUNCTUATION, $previous)
      && $next !== ''
      && !C\contains_key(self::WHITESPACE, $next)
      && !C\contains_key(self::PUNCTUATION, $next)
    ) {
      return false;
    }
    return true;
  }
}
