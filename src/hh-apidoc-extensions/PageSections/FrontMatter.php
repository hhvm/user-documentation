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
use type HHVM\UserDocumentation\{
  LocalConfig,
  YAMLMeta,
};
use namespace HHVM\UserDocumentation\JSON;
use namespace HH\Lib\{Str, Vec};

final class FrontMatter extends PageSection {
  public function getMarkdown(): string {
    $json = JSON\encode_shape(
      YAMLMeta::class,
      $this->getData(),
    );
    return "```yamlmeta\n".$json."\n```";
  }

  private function getData(): YAMLMeta {
    $def = $this->definition;
    $data = shape(
      'name' => $def->getName(),
      'sources' => Vec\map(
        $this->documentable['sources'],
        $source ==> Str\strip_prefix($source, LocalConfig::ROOT.'/'),
      ),
    );

    $class = $this->parent;
    if ($class) {
      $data['class'] = $class->getName();
    }

    // TODO:
    // - $data['lib'] referencing the HSL
    // - fb-only notices for namespace aliases
    // - fb-only notices for foo_async vs gen_foo

    return $data;
  }
}
