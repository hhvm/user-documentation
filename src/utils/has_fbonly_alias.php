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

namespace HHVM\UserDocumentation;

use namespace HH\Lib\{C, Str, Vec};

function get_fbonly_alias(string $fully_qualified_name): ?string {
  $name = $fully_qualified_name;
  if (!Str\starts_with($name, "HH\\Lib\\Experimental\\")) {
    $name = Str\strip_prefix($name, "HH\\Lib\\");
  }
  $parts = Str\split($name, "\\");
  $last = C\lastx($parts);
  $parts = Vec\take($parts, C\count($parts) - 1);

  if ($last === 'from_async') {
    $parts[] = 'gen';
  } else if (Str\ends_with($last, '_async')) {
    $parts[] = 'gen_'.Str\strip_suffix($last, '_async');
  } else {
    $parts[] = $last;
  }
  $name = Str\join($parts, "\\");
  if ($name === $fully_qualified_name) {
    return null;
  }
  return $name;
}
