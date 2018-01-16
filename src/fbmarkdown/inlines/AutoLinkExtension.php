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

class AutoLinkExtension extends Inline {
  // From the GFM spec
  const string DOMAIN = '([a-z0-9_-]+\.)*[a-z0-9-]+\.[a-z0-9]+';
  const string SCHEME = '(http|https|ftp):\/\/';
  const string EMAIL = '[a-z0-9-._+]+@';
  const string PREFIX = 'www\.|'.self::SCHEME.'|'.self::EMAIL;

  const keyset<string> MUST_FOLLOW = keyset[
    "\n", ' ', '*', '_', '~', '(',
  ];

  <<__Override>>
  public function getContentAsPlainText(): string {
    invariant_violation('Should never be called');
  }

  <<__Override>>
  public static function consume(
    Context $_,
    string $markdown,
    int $offset,
  ): ?(Inline, int) {
    if (
      $offset > 0
      && !C\contains_key(self::MUST_FOLLOW, $markdown[$offset - 1])
    ) {
      return null;
    }

    $string = Str\slice($markdown, $offset);

    $matches = [];
    $result = \preg_match(
      '/^(?<prefix>'.self::PREFIX.')(?<domain>'.self::DOMAIN.')/i',
      $string,
      &$matches,
    );
    if ($result !== 1) {
      return null;
    }

    $full = $matches[0];
    $offset += Str\length($full);
    $prefix = $matches['prefix'];
    $domain = $matches['domain'];

    $next = $offset < Str\length($markdown) ? $markdown[$offset] : null;
    if ($next === '-' || $next === '_') {
      return null;
    }

    if (Str\lowercase($prefix) === 'www.') {
      list($path, $offset) = self::consumePath($markdown, $offset);
      $text = $prefix.$domain.$path;
      return tuple(
        new AutoLink($text, 'http://'.$text),
        $offset,
      );
    }
    if (Str\ends_with($prefix, '://')) {
      list($path, $offset) = self::consumePath($markdown, $offset);
      $text = $prefix.$domain.$path;
      return tuple(
        new AutoLink($text, $text),
        $offset,
      );
    }

    // email
    return tuple(
      new AutoLink($full, 'mailto:'.$full),
      $offset,
    );
  }

  // From GFM spec
  const keyset<string> TRAILING_PUNCTUATION = keyset[
    '?', '!', '.', ',', ':', '*', '_', '~',
  ];

  private static function consumePath(
    string $markdown,
    int $offset,
  ): (string, int) {
    $matches = [];
    $rest = Str\slice($markdown, $offset);
    \preg_match('/^[^[\]<> ]+/', $rest, &$matches);
    $match = $matches[0] ?? '';
    if ($match === '') {
      return tuple('', $offset);
    }

    $len = Str\length($match);
    $last = $match[$len - 1];

    if (C\contains_key(self::TRAILING_PUNCTUATION, $last)) {
      $match = Str\slice($match, 0, $len - 1);
      if ($match === '') {
        return tuple('', $offset);
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
          return tuple('', $offset);
        }
        $len--;
        $last = $match[$len - 1];
      }
    }

    if ($last === ';') {
      $idx = Str\search_last($match, '&');
      if ($idx !== null) {
        $slice = Str\slice(
          $match,
          $idx + 1,
          $len -  ($idx + 2),
        );
        if (\ctype_alnum($slice)) {
          $match = Str\slice($match, 0, $idx);
          if ($match === '') {
            return tuple('', $offset);
          }
          $len = $idx;
          $last = $match[$len - 1];
        }
      }
    }

    return tuple($match, $offset + $len);
  }
}
