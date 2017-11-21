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

enum SearchResultType: string {
  HHVM_GUIDE = 'HHVM Guide';
  HACK_GUIDE = 'Hack Guide';
  PHP_API = 'PHP API';
  HACK_API = 'Hack API';
  HSL_API = 'HSL';
};
