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

require_once(BuildPaths::PHP_DOT_NET_API_INDEX);

use namespace HH\Lib\Vec;

final class PHPAPIIndex {
  public static function getIndex(
  ): array<string, PHPDotNetAPIIndexEntry> {
    return PHPDotNetAPIIndexData::getData();
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
        return new SearchResult(
          SearchResultType::PHP_API,
          $score,
          $name,
          $data['url'],
        );
      }),
      Vec\map_with_key(self::getIndex(), ($name, $data) ==> {
        $score = SearchTermMatcher::matchTerm($name, $data['url']);
        if ($score === null) {
          return null;
        }
        return new SearchResult(
          SearchResultType::PHP_API,
          $score * SearchScores::HREF_MATCH_MULTIPLIER,
          $name,
          $data['url'],
        );
      }),
    ) |> Vec\filter_nulls($$);
  }
}
