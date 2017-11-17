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

function type_alias_structure<T>(
  typename<T> $typename,
): TypeStructure<T> {
  return /* HH_IGNORE_ERROR[4104] */ type_structure($typename);
}
