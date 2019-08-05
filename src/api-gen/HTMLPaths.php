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

use type Facebook\HHAPIDoc\IPathProvider;

final class HTMLPaths implements IPathProvider<string> {
  use HHAPIDocExt\APIDefinitionTypeBasedPathProvider<string>;
  private MarkdownPaths $mdPaths;

  private function __construct(APIProduct $product) {
    $this->mdPaths = MarkdownPaths::get($product);
  }

  <<__Memoize>>
  public static function get(APIProduct $product): this {
    return new self($product);
  }

  public function getPathForClassish(
    APIDefinitionType $type,
    string $class,
  ): string {
    return $this->mdPaths->getPathForClassish($type, $class)
      |> APIHTMLBuildStep::getOutputFileName($$);
  }

  public function getPathForClassishMethod(
    APIDefinitionType $type,
    string $class,
    string $method,
  ): string {
    return $this->mdPaths->getPathForClassishMethod($type, $class, $method)
      |> APIHTMLBuildStep::getOutputFileName($$);
  }

  public function getPathForFunction(string $function): string {
    return $this->mdPaths->getPathForFunction($function)
      |> APIHTMLBuildStep::getOutputFileName($$);
  }

}
