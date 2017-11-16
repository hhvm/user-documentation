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

final class PHPAPIIndex {
  public static function getIndex(
  ): array<string, PHPDotNetAPIIndexEntry> {
    return PHPDotNetAPIIndexData::getData();
  }


  public static function search(
    string $term,
  ): SearchResultSet {
    $results = new SearchResultSet();

    // Exact matches first
    foreach (self::getIndex() as $name => $data) {
      if (strcasecmp($name, $term) === 0) {
        $results->addPHPAPIResult($data['type'], $name, $data['url']);
      }
    }

    foreach (self::getIndex() as $name => $data) {
      $url = $data['url'];
      if (
        stripos($name, $term) !== false
        || stripos($name, $url) !== false
      ) {
        $results->addPHPAPIResult($data['type'], $name, $url);
      }
    }
    return $results;
  }
}
