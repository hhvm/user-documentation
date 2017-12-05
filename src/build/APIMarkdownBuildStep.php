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

final class APIMarkdownBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nAPIMarkdownBuild");

    $files = Vec\concat(
      $this->buildProduct(APIProduct::HACK),
      $this->buildProduct(APIProduct::HSL),
    );
    \file_put_contents(
      BuildPaths::APIDOCS_MARKDOWN.'/index.json',
      JSON\encode_shape(DirectoryIndex::class, shape('files' => $files)),
    );
  }

  private function buildProduct(
    APIProduct $product,
  ): vec<string> {
    $in = BuildPaths::APIDOCS_DATA.'/'.$product;
    $out = BuildPaths::APIDOCS_MARKDOWN.'/'.$product;

    if (!is_dir($out)) {
      mkdir($out, /* mode = */ 0755, /* recursive = */ true);
    }

    Log::i("\nGenerating markdown for %s", $product);
    $sources = self::findSources($in, Set{'yml'});
    Log::i("\nGenerating markdown...");
    return Vec\map($sources, $source ==> {
      Log::v('.');
      $filename = pathinfo($source)['filename'];
      $type = explode('.', $filename)[0];
      switch (APIDefinitionType::assert($type)) {
        case APIDefinitionType::FUNCTION_DEF:
          return vec[(new FunctionMarkdownBuilder($product, $source))->build()];
        case APIDefinitionType::CLASS_DEF:
        case APIDefinitionType::INTERFACE_DEF:
        case APIDefinitionType::TRAIT_DEF:
          return Vec\concat(
            vec[(new ClassMarkdownBuilder($product, $source))->build()],
            (new MethodMarkdownBuilder($product, $source))->build(),
          );
      }
    }) |> Vec\flatten($$);
  }
}
