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

namespace Facebook\Markdown\Inlines;

use namespace HH\Lib\{C, Str, Vec};

final class AutoLinkExtension extends Inline {
  // From the GFM spec
  const string DOMAIN = '([a-z0-9_-]+\.)*[a-z0-9-]+\.[a-z0-9]';
  const string SCHEME = '(http|https|ftp):\/\/';
  const string EMAIL = '[-._+]+@';
  const string PREFIX = 'www\.|'.self::SCHEME.'|'.self::EMAIL;

  const keyset<string> MUST_FOLLOW = keyset[
    '', "\n", ' ', '*', '_', '~', '(',
  ];

  <<__Override>>
  public function getContentAsPlainText(): string {
    invariant_violation('Should never be called');
  }

  <<__Override>>
  public static function consume(
    Context $_,
    string $last,
    string $string,
  ): ?(Inline, string, string) {
    if (!C\contains_key(self::MUST_FOLLOW, $last)) {
      return null;
    }
    $last = null;

    $matches = [];
    $result = \preg_match(
      '/^(?<prefix>'.self::PREFIX.')(?<domain>'.self::DOMAIN.')/i',
      $string,
      $matches,
    );
    if ($result !== 1) {
      return null;
    }

    $full = $matches[0];
    $last = $full[Str\length($full) - 1];
    $rest = Str\strip_prefix($string, $full);
    $prefix = $matches['prefix'];
    $domain = $matches['domain'];
    if (Str\lowercase($prefix) === 'www.') {
      list($path, $last, $rest) = self::consumePath($last, $rest);
      $text = $prefix.$domain.$path;
      return tuple(
        new AutoLink($text, 'http://'.$text),
        $last,
        $rest,
      );
    }
    if (Str\ends_with($prefix, '://')) {
      list($path, $last, $rest) = self::consumePath($last, $rest);
      $text = $prefix.$domain.$path;
      return tuple(
        new AutoLink($text, $text),
        $last,
        $rest,
      );
    }

    // email
    return tuple(
      new AutoLink($full, 'mailto:'.$full),
      $last,
      $rest,
    );
  }

  // From GFM spec
  const keyset<string> TRAILING_PUNCTUATION = keyset[
    '?', '!', '.', ',', ':', '*', '_', '~',
  ];

  private static function consumePath(
    string $previous,
    string $rest,
  ): (string, string, string) {
    $matches = [];
    \preg_match('/^[^[\]<> ]+/', $rest, $matches);
    $match = $matches[0];
    if ($match === '') {
      return tuple('', $previous, $rest);
    }

    $len = Str\length($match);
    $last = $match[$len - 1];

    if (C\contains_key(self::TRAILING_PUNCTUATION, $last)) {
      $match = Str\slice($match, 0, $len - 1);
      if ($match === '') {
        return tuple('', $previous, $rest);
      }
      $len--;
      $last = $match[$len - 1];
    }

    if ($last === ')') {
      $chars = Str\split($match, '');
      $opens = Vec\filter($chars, $c ==> $c === '(') |> C\count($$);
      $closes = Vec\filter($chars, $c ==> $c === ')') |> C\count($$);
      if ($closes > $opens) {
        $match = Str\slice($match, 0, $len - 1);
        if ($match === '') {
          return tuple('', $previous, $rest);
        }
        $len--;
        $last = $match[$len - 1];
      }
    }

    if ($last === ';') {
      $idx = Str\search_last($match, '&');
      if ($idx !== null) {
        $slice = Str\slice($match, $idx + 1);
        if (\ctype_alnum($slice)) {
          $match = Str\slice($match, 0, $idx);
          if ($match === '') {
            return tuple('', $previous, $rest);
          }
          $len = $idx;
          $last = $match[$len - 1];
        }
      }
    }

    return tuple($match, $last, Str\strip_prefix($rest, $match));
  }
}
