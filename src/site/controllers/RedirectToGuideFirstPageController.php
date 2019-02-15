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
  Guides,
  GuidesIndex,
  GuidesProduct,
  URLBuilder,
};
use type Facebook\Experimental\Http\Message\ResponseInterface;

final class RedirectToGuideFirstPageController
  extends WebController
  implements RoutableGetController {
  use RedirectToGuideFirstPageControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->guidesProduct('Product')
      ->literal('/')
      ->string('Guide')
      ->literal('/');
  }

  <<__Override>>
  public async function getResponseAsync(
    ResponseInterface $_,
  ): Awaitable<ResponseInterface> {
    $params = $this->getParameters();
    $product = GuidesProduct::assert($params['Product']);
    $guide = $params['Guide'];
    $guide_redirect = Guides::getGuideRedirects($product)[$guide] ?? null;
    $page = null;

    if ($guide_redirect !== null) {
      list($guide, $page) = $guide_redirect;
    }

    if ($page === null) {
      $pages = GuidesIndex::getPages($product, $guide);
      $page = $pages[0];
    }

    $path = self::invariantTo404(() ==> {
      return URLBuilder::getPathForGuidePage($product, $guide, $page);
    });
    throw new RedirectException($path);
  }
}
