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

final class StringKeyedShapes {
  public static function toArray(shape(...) $shape): array<string,mixed> {
    return self::toMap($shape)->toArray();
  }

  public static function toMap(shape(...) $shape): Map<string,mixed> {
    $ret = Map { };
    foreach (Shapes::toArray($shape) as $key => $value) {
      invariant(
        is_string($key),
        'non-string key %s passed as key',
        var_export($key, true),
      );
      $ret[$key] = $value;
    }
    return $ret;
  }
}
