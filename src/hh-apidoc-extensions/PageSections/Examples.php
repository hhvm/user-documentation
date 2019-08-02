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
use type HHVM\UserDocumentation\LocalConfig;
use namespace HH\Lib\{C, Str, Vec};

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
      '%s/api-examples/%s',
      LocalConfig::ROOT,
      Str\replace($subdirectory, '\\', '.'),
    );

    $examples = Vec\concat(\glob($path.'/*.md'), \glob($path.'/*.php'))
      |> Vec\map($$, $file ==> \pathinfo($file, \PATHINFO_FILENAME))
      |> keyset($$);

    if (C\is_empty($examples)) {
      return null;
    }

    $md = "## Examples";

    foreach ($examples as $example) {
      $base = $path.'/'.$example;
      $preamble = $base.'.md';
      $code = $base.'.php';
      if (\file_exists($preamble)) {
        $md .= "\n\n".\file_get_contents($preamble);
      }
      if (\file_exists($code)) {
        $md .= "\n\n@@ ".$code." @@";
      }
    }
    return $md;
  }
}
