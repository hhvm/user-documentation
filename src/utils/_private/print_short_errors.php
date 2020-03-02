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
use namespace HHVM\UserDocumentation\_Private;

<<__ReturnDisposable>>
function print_short_errors(): _Private\ScopeExit {
  $prev = \set_error_handler((
    int $errno,
    string $message,
    string $path,
    int $line,
  ) ==> {
    $short_path = Str\search_last($path, '/')
      |> Str\slice($path, $$ as nonnull);
    \fprintf(
      \STDERR,
      "%s \"%s\" in file \"%s\" at line %d\n",
      errno_to_serverity($errno),
      $message,
      $short_path,
      $line,
    );
  });

  return new _Private\ScopeExit(() ==> \set_error_handler($prev));
}
