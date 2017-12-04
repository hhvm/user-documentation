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

namespace Facebook\GFM\Inlines;

function parse(
    Context $context,
    string $markdown,
  ): vec<Inline> {
  list($parsed, $_last, $rest) = _Private\parse_with_blacklist(
    $context,
    '',
    $markdown,
    keyset[],
  );
  invariant($rest === '', "TextualContent should have taken everything");
  return $parsed;
}
