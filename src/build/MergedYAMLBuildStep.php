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

use namespace Facebook\TypeAssert;

final class MergedYAMLBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nMergedYAMLBuild");
    $sources = (Vector { })
      ->addAll(self::findSources(BuildPaths::HHI_YAML, Set{'yml'}))
      ->addAll(self::findSources(BuildPaths::SYSTEMLIB_YAML, Set{'yml'}))
      ->addAll(self::findSources(BuildPaths::HSL_YAML, Set{'yml'}));
    if (!is_dir(BuildPaths::MERGED_YAML)) {
      mkdir(BuildPaths::MERGED_YAML, /* mode = */ 0755, /* recursive = */ true);
    }
    $builder = new MergedYAMLBuilder(BuildPaths::MERGED_YAML);
    foreach ($sources as $source) {
      Log::v('.');
      $data = JSON\decode_as_shape(BaseYAML::class, file_get_contents($source));
      if ($data['type'] === APIDefinitionType::FUNCTION_DEF) {
        $data = TypeAssert\matches_type_structure(
          type_alias_structure(FunctionYAML::class),
          $data,
        );
      } else {
        $data = TypeAssert\matches_type_structure(
          type_alias_structure(ClassYAML::class),
          $data,
        );
      }
      $builder->addDefinition($data);
    }
    $builder->build();
  }
}
