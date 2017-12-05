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

final class EntityReference extends InlineWithPlainTextContent {
  public static function consume(
    Context $_,
    string $_previous,
    string $string,
  ): ?(Inline, string, string) {
    if ($string[0] !== '&') {
      return null;
    }

    $matches = [];
    if (
      \preg_match(
        '/^&([0-9]{1,8}|#X[0-9a-f]{1,8}|[a-z]+);/i',
        $string,
        $matches,
      ) !== 1
    ) {
      return null;
    }

    $match = $matches[0];

    $out = \html_entity_decode(
      $match,
      /* HH_FIXME[4106] */ /* HH_FIXME[2049] */ \ENT_HTML5,
      'UTF-8',
    );
    if ($out === $match) {
      return null;
    }

    return tuple(
      new self($out),
      ';',
      Str\strip_prefix($string, $match),
    );
  }
}
