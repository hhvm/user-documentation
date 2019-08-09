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

use type HHVM\UserDocumentation\LocalConfig;

class APCCachedRenderable
  implements \XHPUnsafeRenderable, \XHPAlwaysValidChild {
  private function __construct(private string $str) {
  }

  public function toHTMLString(): string {
    return $this->str;
  }

  public static function get(string $key): ?\XHPRoot {
    $str = apc_fetch(self::makeKey($key));
    if (is_string($str)) {
      $ret = <x:frag>{new APCCachedRenderable($str)}</x:frag>;
      return $ret;
    }
    return null;
  }

  public static function store(string $key, \XHPRoot $content): void {
    $str = $content->toString();
    $key = self::makeKey($key);
    apc_store($key, $str);
  }

  private static function makeKey(string $key): string {
    // Might seem overkill for a non-user-controlled cache key, but I don't want
    // to worry about forgetting about it if user input ever ends up in here.
    return hash('sha256', $key.'!!!'.__CLASS__.'!!!'.LocalConfig::getBuildID());
  }
}
