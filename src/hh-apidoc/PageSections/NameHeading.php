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

use type Facebook\DefinitionFinder\{
  ScannedFunctionAbstract,
  ScannedMethod,
};

class NameHeading extends PageSection {
  public function getMarkdown(): string {
    $def = $this->definition;
    if ($def instanceof ScannedMethod) {
      $name = \sprintf(
        '%s%s()',
        $def->isStatic() ? '::' : '->',
        $def->getName(),
      );
    } else if ($def instanceof ScannedFunctionAbstract) {
      $name = $def->getName().'()';
    } else {
      $name = $def->getName();
    }

    return '# '.$name;
  }
}
