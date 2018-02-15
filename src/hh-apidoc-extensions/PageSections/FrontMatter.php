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
use namespace HH\Lib\{C, Str, Vec};

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

    $builtin = C\any(
      $data['sources'],
      $s ==> Str\starts_with($s, 'api-sources/hhvm/'),
    );
    if ($builtin) {
      return $data;
    }

    if (
      C\any($data['sources'], $s ==> Str\starts_with($s, 'api-sources/hsl/'))
    ) {
      $data['lib'] = shape(
        'name' => 'the Hack Standard Library',
        'github' => 'hhvm/hsl',
        'composer' => 'hhvm/hsl',
      );
    }

    $fbonly_messages = vec[];
    $name = Str\strip_prefix($data['name'], "HH\\Lib\\");
    if (Str\ends_with($name, '_async')) {
      $parts = Str\split($name, '\\');
      $last = C\lastx($parts);
     $parts = Vec\take($parts, C\count($parts) - 1);

      if ($last === 'from_async') {
        $parts[] = 'gen';
      } else {
        $parts[] = 'gen_'.Str\strip_suffix($last, '_async');
      }
      $name = Str\join($parts, "\\");
      $fbonly_messages[] = "This function is available as `".$name."()` in ".
          "Facebook's www repository.";
    }

    if (!C\is_empty($fbonly_messages)) {
      $data['fbonly messages'] = $fbonly_messages;
    }

    return $data;
  }
}
