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

use namespace Facebook\TypeAssert;
use namespace HH\Lib\Dict;

class StaticResourceMap {
  private static function getMap(): dict<string, StaticResourceMapEntry> {
    return apc_fetch_or_set_class_data(
      self::class,
      () ==> \file_get_contents(BuildPaths::STATIC_RESOURCES_MAP_JSON)
        |> JSON\decode_as_dict($$)
        |> Dict\map(
          $$,
          $value ==> TypeAssert\matches_type_structure(
            type_alias_structure(StaticResourceMapEntry::class),
            $value,
          ),
        ),
    );
  }

  public static function getEntryForFile(
    string $filename,
  ): StaticResourceMapEntry {
    $entry = self::getNullableEntryForFile($filename);
    invariant($entry !== null, "Couldn't find entry in static resources map");
    return $entry;
  }

  public static function getNullableEntryForFile(
    string $filename,
  ): ?StaticResourceMapEntry {
    $map = self::getMap();
    return $map[$filename] ?? null;
  }
}
