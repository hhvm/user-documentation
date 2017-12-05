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

namespace Facebook\Markdown\Inlines\_Private;

use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{C, Str};

function parse_with_blacklist (
  Inlines\Context $context,
  string $last,
  string $markdown,
  keyset<classname<Inlines\Inline>> $blacklist,
): (vec<Inlines\Inline>, string, string) {
  $types = $context->getInlineTypes();
  foreach ($blacklist as $type) {
    unset($types[$type]);
  }

  $out = vec[];

  while (!Str\is_empty($markdown)) {
    $result = null;
    foreach ($types as $type) {
      $result = $type::consume($context, $last, $markdown);
      if ($result !== null) {
        break;
      }
    }
    if ($result === null) {
      return tuple($out, $last, $markdown);
    }
    list($inline, $last, $markdown) = $result;
    $out[] = $inline;
  }
  return tuple($out, $last, '');
}
