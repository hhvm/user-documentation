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

final class PathProvider implements HHAPIDoc\IPathProvider<?string> {
  private vec<HHAPIDoc\IPathProvider<?string>> $providers;

  public function __construct() {
    $this->providers = APIProduct::getValues()
      |> Vec\map($$, $p ==> new ProductPathProvider($p));
  }

  public function getPathForClass(string $class): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForClass($class))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForInterface(string $class): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForInterface($class))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForTrait(string $class): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForTrait($class))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForClassMethod(
    string $class,
    string $method,
  ): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForClassMethod($class, $method))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForInterfaceMethod(
    string $class,
    string $method,
  ): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForInterfaceMethod($class, $method))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForTraitMethod(
    string $trait,
    string $method,
  ): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForTraitMethod($trait, $method))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForFunction(string $function): ?string {
    return $this->providers
      |> Vec\map($$, $p ==> $p->getPathForFunction($function))
      |> Vec\filter_nulls($$)
      |> C\first($$);
  }

  public function getPathForOpaqueTypeAlias(string $_alias): ?string {
    return null;
  }

  public function getPathForTransparentTypeAlias(string $_alias): ?string {
    return null;
  }
}
