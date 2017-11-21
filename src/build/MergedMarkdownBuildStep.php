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

use namespace HH\Lib\Vec;

final class MergedMarkdownBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nMergedMarkdownBuild");
    $sources = (Vector { })
      ->addAll(self::findSources(BuildPaths::MERGED_YAML, Set{'yml'}));
    if (!is_dir(BuildPaths::APIDOCS_MARKDOWN)) {
      mkdir(BuildPaths::APIDOCS_MARKDOWN, /* mode = */ 0755, /* recursive = */ true);
    }
    Log::i("\nBuilding Markdown");
    $files = Vec\map($sources, $source ==> {
      Log::v('.');
      $filename = pathinfo($source)['filename'];
      $type = explode('.', $filename)[0];
      switch (APIDefinitionType::assert($type)) {
        case APIDefinitionType::FUNCTION_DEF:
          return vec[(new FunctionMarkdownBuilder($source))->build()];
        case APIDefinitionType::CLASS_DEF:
        case APIDefinitionType::INTERFACE_DEF:
        case APIDefinitionType::TRAIT_DEF:
          return Vec\concat(
            vec[(new ClassMarkdownBuilder($source))->build()],
            (new MethodMarkdownBuilder($source))->build(),
          );
      }
    }) |> Vec\flatten($$);
    \file_put_contents(
      BuildPaths::APIDOCS_MARKDOWN.'/index.json',
      JSON\encode_shape(DirectoryIndex::class, shape('files' => $files)),
    );
  }
}
