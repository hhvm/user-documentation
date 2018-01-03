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

class AutoLink extends Inline {
  public function __construct(
    private string $text,
    private string $destination,
  ) {
  }

  public function getText(): string {
    return $this->text;
  }

  public function getDestination(): string {
    return $this->destination;
  }

  <<__Override>>
  public function getContentAsPlainText(): string {
    return $this->text;
  }

  // From GFM spec
  const string ABSOLUTE_URI_PATTERN = '/^[a-z][a-z0-9:=.+-]{1,31}:[^<> ]*$/i';
  const string EMAIL_ADDRESS_PATTERN =
    "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9]".
    '(?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?'.
    '(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/';

  <<__Override>>
  public static function consume(
    Context $_,
    string $string,
    int $offset,
  ): ?(Inline, int) {
    if ($string[$offset] !== '<') {
      return null;
    }
    $start = $offset + 1;

    $end = Str\search($string, '>', $offset);
    if ($end === null) {
      return null;
    }
    $offset = $end + 1;

    $uri = Str\slice($string, $start, $end - $start);
    if (\preg_match(self::ABSOLUTE_URI_PATTERN, $uri) === 1) {
      return tuple(
        new self($uri, $uri),
        $offset,
      );
    }

    if (\preg_match(self::EMAIL_ADDRESS_PATTERN, $uri) === 1) {
      return tuple(
        new self($uri, 'mailto:'.$uri),
        $offset,
      );
    }

    return null;
  }
}
