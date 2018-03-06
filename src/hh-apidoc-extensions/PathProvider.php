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

use type HHVM\UserDocumentation\APIProduct;
use namespace Facebook\HHAPIDoc;
use namespace HH\Lib\{C, Vec};

final class PathProvider implements HHAPIDoc\IPathProvider {
  private vec<HHAPIDoc\IPathProvider> $providers;

  public function __construct() {
    $this->providers = APIProduct::getValues()
      |> Vec\filter($$, $p ==> $p !== APIProduct::PHP)
      |> Vec\map($$, $p ==> new ProductPathProvider($p));
  }

  public function getPathForClass(string $class): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForClass($class))
      |> C\first($$);
  }

  public function getPathForInterface(string $class): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForInterface($class))
      |> C\first($$);
  }

  public function getPathForTrait(string $class): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForTrait($class))
      |> C\first($$);
  }

  public function getPathForClassMethod(
    string $class,
    string $method,
  ): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForClassMethod($class, $method))
      |> C\first($$);
  }

  public function getPathForInterfaceMethod(
    string $class,
    string $method,
  ): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForInterfaceMethod($class, $method))
      |> C\first($$);
  }

  public function getPathForTraitMethod(
    string $trait,
    string $method,
  ): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForTraitMethod($trait, $method))
      |> C\first($$);
  }

  public function getPathForFunction(string $function): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForFunction($function))
      |> C\first($$);
  }
}
