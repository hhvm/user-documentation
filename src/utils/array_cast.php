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

function vec_like_array_cast<T>(
  Traversable<T> $in,
): array<T> {
  $out = [];
  foreach ($in as $v) {
    $out[] = $v;
  }
  return $out;
}
