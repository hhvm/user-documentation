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

use type HHVM\UserDocumentation\{GuidesIndex, GuidesProduct};

final class HomePageController extends WebPageController {
  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())->literal('/');
  }

  <<__Override>>
  public async function getTitleAsync(): Awaitable<string> {
    return 'HHVM and Hack Documentation';
  }

  protected function getInnerContent(GuidesProduct $product): XHPRoot {
    $guides = GuidesIndex::getGuides($product);

    $root = <ul class="guideList" />;
    foreach ($guides as $guide) {
      $pages = GuidesIndex::getPages($product, $guide);
      $url = GuidePageControllerURIBuilder::getPath(shape(
        'Product' => $product,
        'Guide' => $guide,
        'Page' => $pages[0],
      ));

      $title = ucwords(strtr($guide, '-', ' '));

      $root->appendChild(
        <li>
          <h4><a href={$url}>{$title}</a></h4>
          <div class="guideDescription">
            {$this->getGuideSummary($product, $guide)}
          </div>
        </li>,
      );
    }
    return $root;
  }

  protected function getGuideSummary(
    GuidesProduct $product,
    string $guide,
  ): ?XHPRoot {
    $path = GuidesIndex::getFileForSummary($product, $guide);
    if (file_get_contents($path)) {
      return <x:frag>{file_get_contents($path)}</x:frag>;
    }
    return NULL;
  }

  <<__Override>>
  protected async function getBodyAsync(): Awaitable<XHPRoot> {
    return
      <x:frag>
        <div class="guideListWrapper">
          <h2 class="listTitle">Hack</h2>
          <h3 class="listTitle">Learn</h3>
          {$this->getInnerContent(GuidesProduct::HACK)}
          <h3 class="listTitle">
            <a href="/hack/reference/">Hack API Reference</a>
          </h3>
          <p>Full reference docs for all functions, classes, interfaces, and traits in the Hack language.</p>
          <h3 class="listTitle">
            <a href="/hsl/reference/">Hack Standard Library Reference</a>
          </h3>
          <p>Full reference docs for all functions, classes, interfaces, and traits in the Hack Standard Library (HSL).</p>
        </div>
        <div class="guideListWrapper">
          <h2 class="listTitle">HHVM</h2>
          <h3 class="listTitle">Learn</h3>
          {$this->getInnerContent(GuidesProduct::HHVM)}
        </div>
      </x:frag>;
  }
}
