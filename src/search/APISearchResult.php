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

use namespace HH\Lib\Str;

final class APISearchResult extends SearchResult {
  public function __construct(
    APIProduct $product,
    APIDefinitionType $type,
    string $name,
    string $href,
    float $score,
  ) {
    switch ($product) {
      case APIProduct::HSL:
        $score *= SearchScores::HSL_API_MULTIPLIER;
        break;
      case APIProduct::HACK:
      case APIProduct::PHP:
        break;
    }
    parent::__construct(
      $name,
      $href,
      $score,
    );
  }
}
