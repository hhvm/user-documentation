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

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\HTMLFileRenderable;
use HHVM\UserDocumentation\URLBuilder;

final class GuidesListController extends WebPageController {
  use GuidesListControllerParametersTrait;

  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->guidesProduct('Product')
      ->literal('/');
  }

  <<__Override>>
  public async function getTitle(): Awaitable<string> {
    switch ($this->getProduct()) {
      case GuidesProduct::HHVM:
        return 'HHVM Documentation';
      case GuidesProduct::HACK:
        return 'Hack Documentation';
    }
  }

  protected function getInnerContent(): XHPRoot {
    $product = $this->getProduct();
    $guides = GuidesIndex::getGuides($product);

    $root = <ul class="guideList" />;
    foreach ($guides as $guide) {
      $pages = GuidesIndex::getPages($product, $guide);
      $url = URLBuilder::getPathForGuidePage(
        $product,
        $guide,
        $pages[0],
      );

      $title = ucwords(strtr($guide, '-', ' '));

      $root->appendChild(
        <li>
          <h4><a href={$url}>{$title}</a></h4>
          <div class="guideDescription">
            {$this->getGuideSummary($guide)}
          </div>
        </li>
      );
    }
    return $root;
  }

  <<__Override>>
  protected async function getBody(): Awaitable<XHPRoot> {
    $body =
      <x:frag>
        <div class="guideListWrapper">
          <h3 class="listTitle">Learn</h3>
          {$this->getInnerContent()}
        </div>
      </x:frag>;
    if ($this->getProduct() === 'hack') {
      $body->appendChild(
        <div class="guideListWrapper">
          <h3 class="listTitle">
            <a href="/hack/reference/">Built-in API Reference</a>
          </h3>
          <p>
            Full reference docs for all functions, classes, interfaces, and
            traits in the Hack language.
          </p>
          <h3 class="listTitle">
            <a href="/hsl/reference/">Standard Library API Reference</a>
          </h3>
          <p>
            Full reference docs for all functions, classes, interfaces, and
            traits in the Hack Standard Library.
          </p>
        </div>
      );
    }
    return $body;
  }

  protected function getGuideSummary(string $guide): ?XHPRoot {
    $path = GuidesIndex::getFileForSummary(
      $this->getProduct(),
      $guide,
    );
    if (file_get_contents($path)) {
      return <x:frag>{file_get_contents($path)}</x:frag>;
    }
    return NULL;
  }

  <<__Override>>
  protected function getBreadcrumbs(): vec<(string, ?string)> {
    $product = $this->getProduct();
    return vec[
      tuple ($product, URLBuilder::getPathForProductGuides($product)),
      tuple('Learn', null),
    ];
  }

  <<__Memoize>>
  private function getProduct(): GuidesProduct {
    return $this->getParameters()['Product'];
  }
}
