#!/usr/bin/env hhvm
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

<<__EntryPoint>>
async function update_versions_main_async(): Awaitable<noreturn> {
  $root = \realpath(__DIR__.'/..');
  $found_autoloader = false;
  while (true) {
    $autoloader = $root.'/vendor/autoload.hack';
    if (\file_exists($autoloader)) {
      $found_autoloader = true;
      require_once($autoloader);
      \Facebook\AutoloadMap\initialize();
      break;
    }
    if ($root === '') {
      break;
    }
    $parts = \explode('/', $root);
    \array_pop(&$parts);
    $root = \implode('/', $parts);
  }

  if (!$found_autoloader) {
    \fprintf(\STDERR, "Failed to find autoloader.\n");
    exit(1);
  }

  $result = await UpdateTagsCLI::runAsync();
  exit($result);
}
