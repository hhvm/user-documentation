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

namespace HH\Asio;

// Replace calls to these with calls to HH\Asio\va() when that is implemented

async function va2<Ta,Tb>(
  Awaitable<Ta> $a,
  Awaitable<Tb> $b,
): Awaitable<(Ta, Tb)> {
  $list = await v(Vector{$a, $b});
  // UNSAFE
  return tuple($list[0], $list[1]);
}
