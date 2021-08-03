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
    private APIProduct $product,
    private APIDefinitionType $type,
    string $name,
    string $href,
    float $score,
  ) {
    switch ($product) {
      case APIProduct::HSL:
      case APIProduct::HSL_EXPERIMENTAL:
        if (Str\starts_with($name, 'HH\\Lib\\Legacy_FIXME')) {
          $score *= SearchScores::HSL_LEGACY_FIXME_API_MULTIPLIER;
        } else {
          $score *= SearchScores::HSL_API_MULTIPLIER;
        }
        break;
      case APIProduct::HACK:
        $score *= SearchScores::HACK_API_MULTIPLIER;
        break;
    }

    switch ($type) {
      case APIDefinitionType::CLASS_DEF:
        $score *= SearchScores::CLASS_MULTIPLIER;
        break;
      case APIDefinitionType::INTERFACE_DEF:
        $score *= SearchScores::INTERFACE_MULTIPLIER;
        break;
      case APIDefinitionType::TRAIT_DEF:
        $score *= SearchScores::TRAIT_MULTIPLIER;
        break;
      case APIDefinitionType::FUNCTION_DEF:
        if (Str\contains($name, '::')) {
          $score *= SearchScores::METHOD_MULTIPLIER;
        } else {
          $score *= SearchScores::FUNCTION_MULTIPLIER;
        }
        break;
    }

    parent::__construct($name, $href, $score);
  }

  <<__Override>>
  public function getResultTypeText(): string {
    $type = $this->type;
    if ($type === APIDefinitionType::FUNCTION_DEF) {
      if (Str\contains($this->getTitle(), '::')) {
        $type = 'method';
      }
    }
    switch ($this->product) {
      case APIProduct::HACK:
        $product = 'Hack';
        break;
      case APIProduct::HSL:
      case APIProduct::HSL_EXPERIMENTAL:
        $product = 'HSL';
        break;
    }
    return $product.' '.$type;
  }
}
