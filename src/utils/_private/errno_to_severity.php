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

use namespace HH\Lib\Str;

function errno_to_serverity(int $errno): string {
  switch ($errno) {
    case \E_DEPRECATED:
      return 'E_DEPRECATED';
    case \E_NOTICE:
      return 'E_NOTICE';
    case \E_WARNING:
      return 'E_WARNING';
    case \E_RECOVERABLE_ERROR:
      return 'E_RECOVERABLE_ERROR';
    case \E_ERROR:
      return 'E_ERROR';
    case \E_USER_DEPRECATED:
      return 'E_USER_DEPRECATED';
    case \E_USER_NOTICE:
      return 'E_USER_NOTICE';
    case \E_USER_WARNING:
      return 'E_USER_WARNING';
    case \E_USER_ERROR:
      return 'E_USER_ERROR';
    default:
      return Str\format('UNKNOWN_LEVEL(%d)', $errno);
  }
}
