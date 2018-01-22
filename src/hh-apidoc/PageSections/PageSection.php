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

namespace Facebook\HHAPIDoc\PageSections;

use type Facebook\HHAPIDoc\DocBlock\DocBlock;
use type Facebook\DefinitionFinder\ScannedBase;

<<__ConsistentConstruct>>
abstract class PageSection {
  public function __construct(
    protected ScannedBase $definition,
    protected ?DocBlock $docBlock,
  ) {
  }

  abstract public function getMarkdown(): ?string;
}
