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
use type HHVM\UserDocumentation\GuidesNavData;
use namespace HH\Lib\{C, Str};

final class Guides extends PageSection {

  <<__Override>>
  public function getMarkdown(): ?string {
    $guides = $this->docBlock?->getTagsByName('@guide');
    if ($guides is null || C\is_empty($guides)) {
      return null;
    }

    $markdown = '## Guide';
    if (C\count($guides) > 1) {
      $markdown .= 's';
    }
    $markdown .= "\n\n";

    foreach ($guides as $path) {
      $path = Str\strip_suffix($path, '/');
      $name = GuidesNavData::pathToName(C\lastx(Str\split($path, '/')));
      $markdown .= Str\format("* [%s](%s)\n", $name, $path);
    }

    return $markdown;
  }
}
