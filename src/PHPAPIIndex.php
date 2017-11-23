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

use namespace HH\Lib\{Dict, Vec};

use namespace Facebook\TypeAssert;

final class PHPAPIIndex {
  public static function getIndex(
  ): dict<string, PHPDotNetAPIIndexEntry> {
    return apc_fetch_or_set_class_data(
      self::class,
      () ==> \file_get_contents(BuildPaths::PHP_DOT_NET_API_INDEX_JSON)
        |> JSON\decode_as_dict($$)
        |> Dict\map(
          $$,
          $v ==> TypeAssert\matches_type_structure(
            type_alias_structure(PHPDotNetAPIIndexEntry::class),
            $v,
          ),
        ),
    );
  }


  public static function search(
    string $term,
  ): vec<SearchResult> {
    return Vec\concat(
      Vec\map_with_key(self::getIndex(), ($name, $data) ==> {
        $score = SearchTermMatcher::matchTerm($name, $term);
        if ($score === null) {
          return null;
        }
        return new APISearchResult(
          APIProduct::PHP,
          $data['type'],
          $name,
          $data['url'],
          $score,
        );
      }),
      Vec\map_with_key(self::getIndex(), ($name, $data) ==> {
        $score = SearchTermMatcher::matchTerm($name, $data['url']);
        if ($score === null) {
          return null;
        }
        return new APISearchResult(
          APIProduct::PHP,
          $data['type'],
          $name,
          $data['url'],
          $score * SearchScores::HREF_MATCH_MULTIPLIER,
        );
      }),
    ) |> Vec\filter_nulls($$);
  }
}
