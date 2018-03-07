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

class MethodMarkdownBuilder {
  private ClassYAML $yaml;

  public function __construct(
    private APIProduct $product,
    private string $file,
  ) {
    $this->yaml = JSON\decode_as_shape(
      ClassYAML::class,
      \file_get_contents($file),
    );
  }

  public function build(): vec<string> {
    $classname = $this->yaml['data']['name'];
    return Vec\map(
      $this->yaml['data']['methods'],
      $method ==> $this->buildOne($method),
    );
  }

  private function buildOne(
    FunctionDocumentation $method,
  ): string {
    $classname = $this->yaml['data']['name'];
    $md = (new FunctionMarkdownBuilder(
      $this->product,
      $this->file,
      tuple($classname, $method),
    ))->getMarkdown();

    $filename = self::getOutputFileName(
      $this->product,
      APIDefinitionType::assert($this->yaml['type']),
      $this->yaml['data'],
      $method,
    );

    \file_put_contents($filename, $md);
    return $filename;
  }

  public static function getOutputFileName(
    APIProduct $product,
    APIDefinitionType $class_type,
    ClassDocumentation $class,
    FunctionDocumentation $method,
  ): string {
    return MarkdownPaths::get($product)
      ->getPathForClassishMethod($class_type, $class['name'], $method['name']);
  }
}
