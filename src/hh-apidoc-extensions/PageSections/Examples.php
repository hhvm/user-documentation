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

namespace HHVM\UserDocumentation\HHAPIDocExt\PageSections;

use type Facebook\HHAPIDoc\PageSections\PageSection;
use type HHVM\UserDocumentation\BuildPaths;
use namespace HH\Lib\Str;

final class Examples extends PageSection {
  <<__Override>>
  public function getMarkdown(): ?string {
    if ($this->parent !== null) {
      $subdirectory = 'class.'.$this->parent->getName().'/';
    } else {
      $subdirectory = 'function.';
    }
    $subdirectory .= $this->definition->getName();

    $path = Str\format(
      '%s/%s.md',
      BuildPaths::API_EXAMPLES_DIR,
      Str\replace($subdirectory, '\\', '.'),
    );

    return \file_exists($path)
      ? "## Examples\n\n".\file_get_contents($path)
      : null;
  }
}
