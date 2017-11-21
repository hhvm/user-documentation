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

use namespace HH\Lib\Math;

class SearchResult {
  private float $score;

  public function __construct(
    private SearchResultType $type,
    float $score,
    private string $title,
    private string $href,
  ) {
    switch ($type) {
      case SearchResultType::HSL_API:
        $score *= SearchScores::HSL_API_MULTIPLIER;
        break;
      case SearchResultType::HACK_API:
      case SearchResultType::PHP_API:
        break;
      case SearchResultType::HACK_GUIDE:
      case SearchResultType::HHVM_GUIDE:
        $score *= SearchScores::GUIDES_MULTIPLIER;
        $score += SearchScores::GUIDES_BOOST;
        break;
    }
    $this->score = $score;
  }

  final public function getScore(): float {
    return $this->score;
  }

  final public function getTitle(): string {
    return $this->title;
  }

  final public function getHref(): string {
    return $this->href;
  }
}
