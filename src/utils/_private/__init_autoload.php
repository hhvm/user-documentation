<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

/**
 * Convenience function used from examples that need autoloading because they
 * depend on HSL, xhp-lib, or classes/functions declared in other examples.
 *
 * This file is auto_prepended when running any example, so examples can call
 * this function without require[_once]-ing this file.
 *
 * Calls to this function are removed from the example code when it's rendered.
 */
function __init_autoload(): void {
  require_once __DIR__.'/../../../vendor/autoload.hack';
  \Facebook\AutoloadMap\initialize();
}
