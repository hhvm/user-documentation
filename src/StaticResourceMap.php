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

require(BuildPaths::STATIC_RESOURCES_MAP);

class StaticResourceMap {
  private static function getMap(): array<string, StaticResourceMapEntry> {
    return StaticResourceData::getData();
  }

  public static function getEntryForFile(
    string $filename,
  ): StaticResourceMapEntry {
    $map = self::getMap();
    invariant(
      array_key_exists($filename, $map),
      "Filename not in map: %s",
      $filename,
    );
    return $map[$filename];
  }
}
