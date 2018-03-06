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

namespace Facebook\HHAPIDoc;

interface IPathProvider {
  public function getPathForClass(string $class): ?string;
  public function getPathForInterface(string $interface): ?string;
  public function getPathForTrait(string $trait): ?string;

  public function getPathForClassMethod(string $class, string $method): ?string;
  public function getPathForInterfaceMethod(
    string $interface,
    string $method,
  ): ?string;
  public function getPathForTraitMethod(string $trait, string $method): ?string;

  public function getPathForFunction(string $function): ?string;
}
