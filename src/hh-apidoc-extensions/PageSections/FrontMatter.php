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
use type HHVM\UserDocumentation\{LocalConfig, YAMLMeta};
use type Facebook\DefinitionFinder\ScannedClassish;
use namespace HHVM\UserDocumentation\JSON;
use namespace HH\Lib\{C, Str, Vec};

final class FrontMatter extends PageSection {
  <<__Override>>
  public function getMarkdown(): string {
    $json = JSON\encode_shape(YAMLMeta::class, $this->getData());
    return "```yamlmeta\n".$json."\n```";
  }

  private function getData(): YAMLMeta {
    $def = $this->definition;
    $data = shape(
      'name' => $def->getName(),
      'namespace' => $def->getNamespaceName(),
      'sources' => Vec\map(
        $this->documentable['sources'],
        $source ==> Str\strip_prefix($source, LocalConfig::ROOT.'/'),
      ),
    );

    $class = $this->parent;
    if ($class) {
      $data['class'] = $class->getName();
    } else if ($def is ScannedClassish) {
      $data['class'] = $def->getName();
    }

    $top_level_def = $class ?? $def;

    if (
      (
        $top_level_def->getNamespaceName() === "HH\\Lib" ||
        Str\starts_with($top_level_def->getNamespaceName(), "HH\\Lib\\")
      ) &&
      !C\any($data['sources'], $s ==> Str\starts_with($s, 'api-sources/hsl-experimental'))
    ) {
      $data['fbonly messages'] ??= vec[];
      $data['fbonly messages'][] = Str\format(
        '%s is available as `%s` in the www repository.',
        $class is nonnull ? 'The containing class' : 'This',
        Str\strip_prefix($top_level_def->getName(), 'HH\\Lib\\'),
      );
    } else if (
      C\any(
        $data['sources'],
        $s ==> Str\starts_with($s, 'api-sources/hsl-experimental/'),
      )
    ) {
      $data['lib'] = shape(
        'name' => 'the Hack Standard Library - Experimental Additions',
        'github' => 'hhvm/hsl-experimental',
        'composer' => 'hhvm/hsl-experimental',
      );
    }


    return $data;
  }
}
