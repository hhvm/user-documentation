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

use type HHVM\UserDocumentation\{
  APIProduct,
  GuidesProduct,
};

abstract final class Breadcrumbs {
  public static function getRootAPIBreadcrumb(
    APIProduct $product,
  ): (string, ?string) {
    switch ($product) {
      case APIProduct::HACK:
        return tuple(
          'Hack',
          GuidesListControllerURIBuilder::getPath(shape(
            'Product' => GuidesProduct::HACK,
          )),
        );
      case APIProduct::HSL:
        return tuple('HSL', null);
    }
  }
}
