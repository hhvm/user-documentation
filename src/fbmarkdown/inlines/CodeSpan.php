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

use namespace HH\Lib\Str;

final class CodeSpan extends Inline {
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
    string $previous,
    string $string,
  ): ?(this, string, string) {
    if ($previous === '`') {
      return null;
    }

    if ($string[0] !== '`') {
      return null;
    }

    $len = Str\length($string);
    for ($i = 1; $i < $len; ++$i) {
      if ($string[$i] !== '`') {
        break;
      }
    }
    $marker = Str\repeat('`', $i);
    $end = Str\search($string, $marker, $i);
    while (
      $end !== null
      && (
        ($end + $i < $len && $string[$end + $i] === '`')
        || $string[$end - 1] === '`'
      )
    ) {
      $end = Str\search($string, $marker, $end + 1);
    }
    if ($end === null) {
      return null;
    }

    return tuple(
      new self(
        Str\slice($string, $i, $end - $i)
        |> Str\trim($$)
        |> \preg_replace('/\s+/m', ' ', $$),
      ),
      '`',
      Str\slice($string, $end + $i),
    );
  }

  public function getCode(): string {
    return $this->code;
  }
}
