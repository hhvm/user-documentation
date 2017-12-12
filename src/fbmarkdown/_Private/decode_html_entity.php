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

namespace Facebook\Markdown\_Private;

use namespace HH\Lib\Str;

const string UNICODE_REPLACEMENT_CHARACTER = "\u{fffd}";

function decode_html_entity(string $string): ?(string, string, string) {
  if ($string[0] !== '&') {
    return null;
  }

  $matches = [];
  if (
    \preg_match(
      '/^&(#[0-9]{1,8}|#X[0-9a-f]{1,8}|[a-z]+);/i',
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
  if ($out === "\000") {
    $out = UNICODE_REPLACEMENT_CHARACTER;
  } else if (!\mb_check_encoding($out, 'UTF-8')) {
    $out = UNICODE_REPLACEMENT_CHARACTER;
  }
  return tuple($match, $out, Str\strip_prefix($string, $match));
}
