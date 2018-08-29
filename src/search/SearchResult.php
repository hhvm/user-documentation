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


abstract class SearchResult {

  public function __construct(
    private string $title,
    private string $href,
    private float $score,
  ) {
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

  abstract public function getResultTypeText(): string;
}
