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

namespace Facebook\Markdown\UnparsedBlocks;

use namespace HH\Lib\{Vec, Str};

function parse(
  Context $context,
  string $markdown,
): Document {
  $lines = $markdown
    |> Str\split($$, "\n")
    |> Vec\map($$, $line ==> tuple(0, $line))
    |> new Lines($$);
  list($document, $_) = Document::consume($context, $lines);
  return $document;
}
