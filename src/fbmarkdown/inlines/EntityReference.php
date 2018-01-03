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

use function \Facebook\Markdown\_Private\decode_html_entity;
use namespace HH\Lib\Str;

class EntityReference extends InlineWithPlainTextContent {

  <<__Override>>
  public static function consume(
    Context $_,
    string $markdown,
    int $offset,
  ): ?(Inline, int) {
    $result = decode_html_entity(Str\slice($markdown, $offset));
    if ($result === null) {
      return null;
    }

    list($match, $out, $_rest) = $result;

    return tuple(new self($out), $offset + Str\length($match));
  }
}
