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

function stringify_generic(
  ScannedGeneric $generic,
): string {
  if ($generic->isCovariant()) {
    $base = '+';
  } else if ($generic->isContravariant()) {
    $base = '-';
  } else {
    $base = '';
  }
  $base .= $generic->getName();

  $constraints = $generic->getConstraints();
  if (C\is_empty($constraints)) {
    return $base;
  }

  return $constraints
    |> Vec\map($$, $c ==> $c['relationship'].' '.$c['type'])
    |> Str\join($$, ' ')
    |> $base.' '.$$;
}
