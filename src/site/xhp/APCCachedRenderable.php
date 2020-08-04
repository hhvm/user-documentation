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

namespace HHVM\UserDocumentation\ui;

use namespace Facebook\XHP;
use namespace Facebook\XHP\Core as x;
use type HHVM\UserDocumentation\LocalConfig;

final class APCCachedRenderable
  implements XHP\UnsafeRenderable, XHP\AlwaysValidChild {
  private function __construct(private string $str) {
  }

  public async function toHTMLStringAsync(): Awaitable<string> {
    return $this->str;
  }

  public static function get(string $key): ?x\node {
    $_success = null;
    $str = \apc_fetch(self::makeKey($key), inout $_success);
    if (\is_string($str)) {
      $ret = <x:frag>{new APCCachedRenderable($str)}</x:frag>;
      return $ret;
    }
    return null;
  }

  public static function store(string $key, x\node $content): void {
    $str = \HH\Asio\join($content->toStringAsync());
    $key = self::makeKey($key);
    \apc_store($key, $str);
  }

  private static function makeKey(string $key): string {
    // Might seem overkill for a non-user-controlled cache key, but I don't want
    // to worry about forgetting about it if user input ever ends up in here.
    return \hash('sha256', $key.'!!!'.__CLASS__.'!!!'.LocalConfig::getBuildID());
  }
}
