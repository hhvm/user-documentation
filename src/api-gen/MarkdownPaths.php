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
use namespace HH\Lib\Str;

final class MarkdownPaths implements IPathProvider<string> {
  use HHAPIDocExt\APIDefinitionTypeBasedPathProvider<string>;

  private function __construct(private APIProduct $product) {
  }

  <<__Memoize>>
  public static function get(APIProduct $product): this {
    return new self($product);
  }

  public function getPathForClassish(
    APIDefinitionType $type,
    string $class,
  ): string {
    return \sprintf(
      '%s/%s/%s.%s.md',
      BuildPaths::APIDOCS_MARKDOWN,
      $this->product,
      $type,
      Str\replace($class, "\\", '.'),
    );
  }

  public function getPathForClassishMethod(
    APIDefinitionType $type,
    string $class,
    string $method,
  ): string {
    return $this->getPathForClassish($type, $class)
      |> Str\strip_suffix($$, '.md')
      |> $$.\sprintf('.method.%s.md', $method);
  }

  public function getPathForFunction(string $function): string {
    return \sprintf(
      '%s/%s/function.%s.md',
      BuildPaths::APIDOCS_MARKDOWN,
      $this->product,
      Str\replace($function, "\\", '.'),
    );
  }
}
