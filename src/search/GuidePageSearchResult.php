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

final class GuidePageSearchResult extends SearchResult {
  public function __construct(
    private GuidesProduct $product,
    string $guide,
    string $page,
    float $score,
  ) {
    $score *= SearchScores::GUIDES_MULTIPLIER;
    $score += SearchScores::GUIDES_BOOST;

    $title = Guides::normalizeName($product, $guide, $page);
    $href = URLBuilder::getPathForGuidePage($product, $guide, $page);
    parent::__construct(
      $title,
      $href,
      $score,
    );
  }

  <<__Override>>
  public function getResultTypeText(): string {
    switch ($this->product) {
      case GuidesProduct::HACK:
        $product = 'Hack';
        break;
      case GuidesProduct::HHVM:
        $product = 'HHVM';
        break;
    }
    return $product.' guide';
  }
}
