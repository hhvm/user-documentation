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
use namespace Facebook\TypeAssert;

final class APIIndexBuildStep extends BuildStep {
  <<__Override>>
  public function buildAll(): void {
    Log::i("\nAPIIndexBuild");

    $full_index = shape(
      APIProduct::HACK => $this->createIndex(APIProduct::HACK),
      APIProduct::HSL => $this->createIndex(APIProduct::HSL),
    );
    \file_put_contents(
      BuildPaths::APIDOCS_INDEX_JSON,
      JSON\encode_shape(
        APIIndexShape::class,
        $full_index,
      ),
    );
  }

  private function createIndex(
    APIProduct $product,
  ): ProductAPIIndexShape {
    $list = BuildPaths::APIDOCS_DATA.'/'.$product
      |> self::findSources($$, ImmSet {'yml'})
      |> Vec\sort($$);

    Log::i("\nCreating index for %s", $product);

    $out = shape(
      'class' => dict[],
      'interface' => dict[],
      'trait' => dict[],
      'function' => dict[],
    );
    foreach ($list as $yaml_path) {
      Log::v('.');
      $data = JSON\decode_as_shape(
        BaseYAML::class,
        \file_get_contents($yaml_path),
      );

      $type = $data['type'];
      switch ($type) {
        case APIDefinitionType::FUNCTION_DEF:
          $docs = TypeAssert\matches_type_structure(
            type_alias_structure(FunctionDocumentation::class),
            $data['data'],
          );

          $idx = \strtr($docs['name'], "\\", '.');
          $md_path = FunctionMarkdownBuilder::getOutputFileName(
            $product,
            $docs,
          );
          $html_path = APIHTMLBuildStep::getOutputFileName($md_path);

          $out['function'][$idx] = shape(
            'name' => $docs['name'],
            'htmlPath' => $html_path,
            'urlPath' => URLBuilder::getPathForFunction($product, $docs),
          );
          break;
        case APIDefinitionType::CLASS_DEF:
        case APIDefinitionType::INTERFACE_DEF:
        case APIDefinitionType::TRAIT_DEF:
          $class = TypeAssert\matches_type_structure(
            type_alias_structure(ClassDocumentation::class),
            $data['data'],
          );

          $methods = dict[];
          foreach ($class['methods'] as $method) {
            $idx = \strtr($method['name'], "\\", '.');
            $md_path = MethodMarkdownBuilder::getOutputFileName(
              $product,
              $type,
              $class,
              $method,
            );
            $html_path = APIHTMLBuildStep::getOutputFileName($md_path);
            $methods[$idx] = shape(
              'name' => $method['name'],
              'className' => $class['name'],
              'classType' => $type,
              'htmlPath' => $html_path,
              'urlPath' => URLBuilder::getPathForMethod($product, $method),
            );
          }

          $md_path = ClassMarkdownBuilder::getOutputFileName(
            $product,
            $type,
            $class,
          );
          $html_path = APIHTMLBuildStep::getOutputFileName($md_path);

          $idx = \strtr($class['name'], "\\", '.');
          $entry = shape(
            'name' => $class['name'],
            'type' => $type,
            'htmlPath' => $html_path,
            'urlPath' => URLBuilder::getPathForClass($product, $class),
            'methods' => $methods,
          );

          switch ($type) {
            case APIDefinitionType::CLASS_DEF:
              $out['class'][$idx] = $entry;
              break;
            case APIDefinitionType::INTERFACE_DEF:
              $out['interface'][$idx] = $entry;
              break;
            case APIDefinitionType::TRAIT_DEF:
              $out['trait'][$idx] = $entry;
              break;
            case APIDefinitionType::FUNCTION_DEF:
              invariant_violation('unreachable');
          }
          break;
      }
    }

    return $out;
  }
}
