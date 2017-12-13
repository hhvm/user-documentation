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
  string $markdown,
  int $offset,
  keyset<classname<Inlines\Inline>> $blacklist,
): (vec<Inlines\Inline>, int) {
  $types = $context->getInlineTypes();
  foreach ($blacklist as $type) {
    unset($types[$type]);
  }

  $out = vec[];
  $len = Str\length($markdown);

  while ($offset < $len) {
    $result = null;
    foreach ($types as $type) {
      $result = $type::consume($context, $markdown, $offset);
      if ($result !== null) {
        break;
      }
    }
    if ($result === null) {
      return tuple($out, $offset);
    }
    list($inline, $new_offset) = $result;
    invariant(
      $new_offset > $offset,
      "Failed to consume any data with %s",
      get_class($inline),
    );
    $offset = $new_offset;
    $out[] = $inline;
  }
  return tuple($out, $offset);
}
