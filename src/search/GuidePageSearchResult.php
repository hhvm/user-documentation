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
    GuidesProduct $product,
    string $guide,
    string $page,
    float $score,
  ) {
    switch ($product) {
      case GuidesProduct::HHVM:
        $type = SearchResultType::HHVM_GUIDE;
        break;
      case GuidesProduct::HACK:
        $type = SearchResultType::HACK_GUIDE;
        break;
    }
    $title = Guides::normalizeName($product, $guide, $page);
    $href = URLBuilder::getPathForGuidePage($product, $guide, $page);
    parent::__construct(
      $type,
      $score,
      $title,
      $href,
    );
  }
}
