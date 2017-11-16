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

final class APIIndexBuildStep extends BuildStep {
  use CodegenBuildStep;

  public function buildAll(): void {
    Log::i("\nAPIIndexBuild");

    $sources = self::findSources(BuildPaths::MERGED_YAML, Set{'yml'});
    sort($sources);

    $this->createIndex($sources);
  }

  private function createIndex(
    Iterable<string> $list,
  ): void {
    Log::i("\nCreate Index");

    $index = $this->generateIndexData($list);
    $code = $this->writeCode(
      'APIIndexData.hhi',
      $index,
    );
    file_put_contents(
      BuildPaths::APIDOCS_INDEX,
      $code,
    );
  }

  private function generateIndexData(
    Iterable<string> $list,
  ): APIIndexShape {
    $out = shape(
      'class' => [],
      'interface' => [],
      'trait' => [],
      'function' => [],
    );
    foreach ($list as $yaml_path) {
      Log::v('.');
      $data = ((): BaseYAML ==> \Spyc::YAMLLoad($yaml_path))(); // cast :p

      $type = $data['type'];
      switch ($type) {
        case APIDefinitionType::FUNCTION_DEF:
          $docs = (
            (): FunctionDocumentation ==> /* UNSAFE_EXPR */ $data['data']
          )();

          $idx = strtr($docs['name'], "\\", '.');
          $md_path = FunctionMarkdownBuilder::getOutputFileName($docs);
          $html_path = APIHTMLBuildStep::getOutputFileName($md_path);

          $out['function'][$idx] = shape(
            'name' => $docs['name'],
            'htmlPath' => $html_path,
            'urlPath' => URLBuilder::getPathForFunction($docs),
          );
          break;
        case APIDefinitionType::CLASS_DEF:
        case APIDefinitionType::INTERFACE_DEF:
        case APIDefinitionType::TRAIT_DEF:
          $class = (
            (): ClassDocumentation ==> /* UNSAFE_EXPR */ $data['data']
          )();


          $methods = [];
          foreach ($class['methods'] as $method) {
            $idx = strtr($method['name'], "\\", '.');
            $md_path = MethodMarkdownBuilder::getOutputFileName(
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
              'urlPath' => URLBuilder::getPathForMethod($method),
            );
          }

          $md_path = ClassMarkdownBuilder::getOutputFileName(
            $type,
            $class,
          );
          $html_path = APIHTMLBuildStep::getOutputFileName($md_path);
      
          $idx = strtr($class['name'], "\\", '.');
          $entry = shape(
            'name' => $class['name'],
            'type' => $type,
            'htmlPath' => $html_path,
            'urlPath' => URLBuilder::getPathForClass($class),
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
