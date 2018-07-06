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

use type HHVM\UserDocumentation\{APIDefinitionType,
  APIProduct,
  GuidesProduct
};

final class UriPattern extends \Facebook\HackRouter\UriPattern {
  public function apiProduct(string $name): this {
    return $this->enum(APIProduct::class, $name);
  }

  public function guidesProduct(string $name): this {
    return $this->enum(GuidesProduct::class, $name);
  }

  public function definitionType(string $name): this {
    return $this->enum(APIDefinitionType::class, $name);
  }
}
