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
      $builder->addDefinition(\Spyc::YAMLLoad($source));
    }
    $builder->build();
  }
}
