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

final class EntityReference extends InlineWithPlainTextContent {

  <<__Override>>
  public static function consume(
    Context $_,
    string $_previous,
    string $string,
  ): ?(Inline, string, string) {
    $result = decode_html_entity($string);
    if ($result === null) {
      return null;
    }

    list($_match, $out, $rest) = $result;

    return tuple(new self($out), ';', $rest);
  }
}
