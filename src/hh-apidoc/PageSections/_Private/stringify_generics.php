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

namespace Facebook\HHAPIDoc\PageSections\_Private;

use type Facebook\DefinitionFinder\ScannedGeneric;
use namespace HH\Lib\{C, Str, Vec};

function stringify_generics(
  vec<ScannedGeneric> $generics,
): string {
  if (C\is_empty($generics)) {
    return '';
  }

  return $generics
    |> Vec\map($$, $g ==> stringify_generic($g))
    |> Str\join($$, ', ')
    |> '<'.$$.'>';
}
