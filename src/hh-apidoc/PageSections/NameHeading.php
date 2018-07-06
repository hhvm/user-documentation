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

use type Facebook\DefinitionFinder\ScannedFunctionish;

class NameHeading extends PageSection {
  public function getMarkdown(): string {
    $md = '# ';
    if ($this->parent) {
      $md .= $this->parent->getName().'::';
    }
    $def = $this->definition;
    $md .= $def->getName();

    if ($def instanceof ScannedFunctionish) {
      $md .= '()';
    }

    return $md;
  }
}
