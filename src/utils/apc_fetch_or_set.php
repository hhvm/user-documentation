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

function apc_fetch_or_set_class_data<Tclass, Tdata>(
  classname<Tclass> $class,
  (function(): Tdata) $fetcher,
): Tdata {
  return _Private\apc_fetch_or_set_raw('class!'.$class, $fetcher);
}

function apc_fetch_or_set_method_data<Tclass, Tdata>(
  classname<Tclass> $class,
  string $method,
  (function(): Tdata) $fetcher,
): Tdata {
  return _Private\apc_fetch_or_set_raw('fun!'.$class.'::'.$method, $fetcher);
}

function apc_fetch_or_set_function_data<Tclass, Tdata>(
  string $fun,
  (function(): Tdata) $fetcher,
): Tdata {
  return _Private\apc_fetch_or_set_raw('fun!'.$fun, $fetcher);
}
