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

use type HHVM\UserDocumentation\APIProduct;

final class APIListByTypeController extends WebPageController {
  use APIListByTypeControllerParametersTrait;

  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('Product')
      ->literal('/reference/')
      ->definitionType('Type')
      ->literal('/');
  }

  <<__Override>>
  protected function getBreadcrumbs(): vec<(string, ?string)> {
    $parameters = $this->getParameters();
    return vec[
      Breadcrumbs::getRootAPIBreadcrumb($parameters['Product']),
      tuple(
        'Reference',
        APIFullListControllerURIBuilder::getPath(shape(
          'Product' => $parameters['Product'],
        )),
      ),
      tuple(
        \ucwords($parameters['Type']),
        APIListByTypeControllerURIBuilder::getPath($parameters),
      ),
    ];
  }

  <<__Override>>
  protected async function getTitleAsync(): Awaitable<string> {
    switch ($this->getParameters()['Product']) {
      case APIProduct::HACK:
        return 'Hack APIs';
      case APIProduct::HSL:
        return 'The Hack Standard Library';
      case APIProduct::HSL_EXPERIMENTAL:
        return 'The Hack Standard Library - Experimental Additions';
    }
  }

  <<__Override>>
  final protected async function getBodyAsync(): Awaitable<XHPRoot> {
    return
      <api-list
        product={$this->getParameters()['Product']}
        types={ImmSet {$this->getParameters()['Type']}}
      />;
  }
}
