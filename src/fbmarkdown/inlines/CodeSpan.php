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

use namespace Facebook\Markdown\Inlines\_Private\StrPos;
use namespace HH\Lib\Str;

<<__ConsistentConstruct>>
class CodeSpan extends Inline {
  public function __construct(
    private string $code,
  ) {
  }

  <<__Override>>
  public function getContentAsPlainText(): string {
    return $this->code;
  }

  <<__Override>>
  public static function consume(
    Context $_,
    string $string,
    int $offset,
  ): ?(this, int) {
    if ($offset > 0 && $string[$offset - 1] === '`') {
      return null;
    }

    if ($string[$offset] !== '`') {
      return null;
    }

    $start = StrPos\trim_left($string, $offset, '`');
    $marker_len = $start - $offset;
    $marker = Str\repeat('`', $marker_len);
    $end = Str\search($string, $marker, $start);

    $len = Str\length($string);
    while (
      $end !== null
      && (
        ($end + $marker_len < $len && $string[$end + $marker_len] === '`')
        || $string[$end - 1] === '`'
      )
    ) {
      $end = Str\search($string, $marker, $end + 1);
    }
    if ($end === null) {
      return null;
    }

    return tuple(
      new static(
        Str\slice($string, $start, $end - $start)
        |> Str\trim($$)
        |> \preg_replace('/\s+/m', ' ', $$),
      ),
      $end + $marker_len,
    );
  }

  public function getCode(): string {
    return $this->code;
  }
}
