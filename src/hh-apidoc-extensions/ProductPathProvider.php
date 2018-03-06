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

final class ProductPathProvider implements HHAPIDoc\IPathProvider {
  private APIIndex $index;

  public function __construct(
    APIProduct $product,
  ) {
    $this->index = APIIndex::get($product);
  }

  private function getPathForClassish(
    APIDefinitionType $type,
    string $class,
  ): ?string {
    $def = $this->index->getClassIndex($type)[$class] ?? null;
    return $def === null ? null : $def['urlPath'];
  }

  public function getPathForClass(string $class): ?string {
    return $this->getPathForClassish(APIDefinitionType::CLASS_DEF, $class);
  }

  public function getPathForInterface(string $class): ?string {
    return $this->getPathForClassish(APIDefinitionType::INTERFACE_DEF, $class);
  }

  public function getPathForTrait(string $class): ?string {
    return $this->getPathForClassish(APIDefinitionType::TRAIT_DEF, $class);
  }

  private function getPathForClassishMethod(
    APIDefinitionType $type,
    string $class,
    string $method,
  ): ?string {
    $class = $this->index->getClassIndex($type)[$class] ?? null;
    if ($class === null) {
      return null;
    }
    $method = $class['methods'][$method] ?? null;
    return $method === null ? null : $method['urlPath'];
  }

  public function getPathForClassMethod(
    string $class,
    string $method,
  ): ?string {
    return $this->getPathForClassishMethod(
      APIDefinitionType::CLASS_DEF,
      $class,
      $method,
    );
  }

  public function getPathForInterfaceMethod(
    string $class,
    string $method,
  ): ?string {
    return $this->getPathForClassishMethod(
      APIDefinitionType::INTERFACE_DEF,
      $class,
      $method,
    );
  }
  public function getPathForTraitMethod(
    string $trait,
    string $method,
  ): ?string {
    return $this->getPathForClassishMethod(
      APIDefinitionType::TRAIT_DEF,
      $trait,
      $method,
    );
  }

  public function getPathForFunction(string $function): ?string {
    $def = $this->index->getFunctionIndex()[$function] ?? null;
    if ($def === null) {
      return null;
    }
    return $def['urlPath'];
  }
}
