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

namespace HHVM\UserDocumentation\HHAPIDocExt;

use namespace Facebook\HHAPIDoc;
use type HHVM\UserDocumentation\{
  APIDefinitionType,
  APIIndex,
  APIProduct,
};
use namespace HH\Lib\Str;

final class ProductPathProvider implements HHAPIDoc\IPathProvider {
  use APIDefinitionTypeBasedPathProvider<?string>;
  private APIIndex $index;

  public function __construct(
    APIProduct $product,
  ) {
    $this->index = APIIndex::get($product);
  }

  private static function normalize(string $name): string {
    return Str\replace($name, "\\", '.');
  }

  protected function getPathForClassish(
    APIDefinitionType $type,
    string $class,
  ): ?string {
    $def = $this->index->getClassIndex($type)[self::normalize($class)] ?? null;
    return $def === null ? null : $def['urlPath'];
  }

  protected function getPathForClassishMethod(
    APIDefinitionType $type,
    string $class,
    string $method,
  ): ?string {
    $class = $this->index
      ->getClassIndex($type)[self::normalize($class)] ?? null;
    if ($class === null) {
      return null;
    }
    $method = $class['methods'][$method] ?? null;
    return $method === null ? null : $method['urlPath'];
  }

  public function getPathForFunction(string $function): ?string {
    $def = $this->index->getFunctionIndex()[self::normalize($function)] ?? null;
    if ($def === null) {
      return null;
    }
    return $def['urlPath'];
  }
}
