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

use type HHVM\UserDocumentation\APIDefinitionType;
use namespace Facebook\HHAPIDoc;

trait APIDefinitionTypeBasedPathProvider<T as ?string> {
  require implements HHAPIDoc\IPathProvider;

  abstract protected function getPathForClassish(
    APIDefinitionType $type,
    string $class,
  ): T;

  abstract protected function getPathForClassishMethod(
    APIDefinitionType $type,
    string $class,
    string $method,
  ): T;

  final public function getPathForClass(string $class): T {
    return $this->getPathForClassish(APIDefinitionType::CLASS_DEF, $class);
  }

  public function getPathForInterface(string $class): T {
    return $this->getPathForClassish(APIDefinitionType::INTERFACE_DEF, $class);
  }

  public function getPathForTrait(string $class): T {
    return $this->getPathForClassish(APIDefinitionType::TRAIT_DEF, $class);
  }

  final public function getPathForClassMethod(
    string $class,
    string $method,
  ): T {
    return $this->getPathForClassishMethod(
      APIDefinitionType::CLASS_DEF,
      $class,
      $method,
    );
  }

  final public function getPathForInterfaceMethod(
    string $class,
    string $method,
  ): T {
    return $this->getPathForClassishMethod(
      APIDefinitionType::INTERFACE_DEF,
      $class,
      $method,
    );
  }
  public function getPathForTraitMethod(
    string $trait,
    string $method,
  ): T {
    return $this->getPathForClassishMethod(
      APIDefinitionType::TRAIT_DEF,
      $trait,
      $method,
    );
  }
}
