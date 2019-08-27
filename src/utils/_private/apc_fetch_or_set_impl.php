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

namespace HHVM\UserDocumentation\_Private;

use type HHVM\UserDocumentation\LocalConfig;

function apc_fetch_or_set_raw<Tdata>(
  string $key,
  (function(): Tdata) $fetcher,
): Tdata {
  $key .= '!'.LocalConfig::getBuildID();
  $success = false;
  $data = \apc_fetch($key, inout $success);
  if ($success) {
    return $data;
  }

  $data = $fetcher();
  \apc_store($key, $data);
  return $data;
}
