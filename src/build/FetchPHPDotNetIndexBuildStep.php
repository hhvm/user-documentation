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

final class FetchPHPDotNetIndexBuildStep extends BuildStep {
  const string SOURCE = 'http://php.net/manual/en/search-index.json';

  <<__Override>>
  public function buildAll(): void {
    Log::v("\nFetching php.net documentation index...");
    $json = \file_get_contents(self::SOURCE);
    $data = \json_decode($json);
    invariant(
      is_array($data),
      '%s is not a json array',
      self::SOURCE,
    );
    invariant(
      is_array($data[0]),
      '%s is not an array of arrays',
      self::SOURCE,
    );
    foreach ($data as $row) {
      invariant(
        \count($row) === 3,
        '%s is not an array of 3-entry arrays',
        self::SOURCE,
      );
    }
    \file_put_contents(BuildPaths::PHP_DOT_NET_INDEX_JSON, $json);
  }
}
