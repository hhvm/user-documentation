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

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{a, div, h2, h3, h4, li, p, ul};
use type HHVM\UserDocumentation\{CategoriesHHVM, CategoriesHack, GuidesIndex, GuidesProduct};

final class HomePageController extends WebPageController {
  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())->literal('/');
  }

  <<__Override>>
  public async function getTitleAsync(): Awaitable<string> {
    return 'HHVM and Hack Documentation';
  }

  protected function getInnerContent(GuidesProduct $product): x\node {
    $guides = GuidesIndex::getGuides($product);

    $root = <ul />;

    // Hack / HHVM  categories
    $category_root = $root;
    $getting_started = <ul class="guideList" />;
    $control_flow = <ul class="guideList" />;
    $classes_interfaces_traits = <ul class="guideList" />;
    $types_generics = <ul class="guideList" />;
    $learn = <ul class="guideList" />;

    foreach ($guides as $guide) {
      $pages = GuidesIndex::getPages($product, $guide);
      $url = GuidePageControllerURIBuilder::getPath(shape(
        'Product' => $product,
        'Guide' => $guide,
        'Page' => $pages[0],
      ));

      $title = ucwords(strtr($guide, '-', ' '));
      $category = trim($this->getGuideCategory($product, $guide));

      switch($category){
        case CategoriesHack::GETTING_STARTED:
          $category_root = $getting_started;
          break;
        case CategoriesHack::CONTROL_FLOW:
          $category_root = $control_flow;
          break;
        case CategoriesHack::CLASSES_INTERFACES_TRAITS:
          $category_root = $classes_interfaces_traits;
          break;
        case CategoriesHack::TYPES_GENERICS:
          $category_root = $types_generics;
          break;
        case CategoriesHHVM::LEARN:
          $category_root = $learn;
          break;
        default:
          $category_root = $root;
          break;
      }

      $category_root->appendChild(
        <li>
          <h4 class={$category}><a href={$url}>{$title}</a></h4>
          <div class="guideDescription">
            {$this->getGuideSummary($product, $guide)}
          </div>
        </li>,
      );
    }

    if ($product === GuidesProduct::HACK){
      $root->appendChild(<li><h3 class="listTitle">{CategoriesHack::GETTING_STARTED}</h3><div class="guideListWrapper">{$getting_started}</div></li>);
      $root->appendChild(<li><h3 class="listTitle">{CategoriesHack::CONTROL_FLOW}</h3><div class="guideListWrapper">{$control_flow}</div></li>);
      $root->appendChild(<li><h3 class="listTitle">{CategoriesHack::CLASSES_INTERFACES_TRAITS}</h3><div class="guideListWrapper">{$classes_interfaces_traits}</div></li>);
      $root->appendChild(<li><h3 class="listTitle">{CategoriesHack::TYPES_GENERICS}</h3><div class="guideListWrapper">{$types_generics}</div></li>);
    }

    if ($product === GuidesProduct::HHVM){
      $root->appendChild(<li><h3 class="listTitle">{CategoriesHHVM::LEARN}</h3><div>{$learn}</div></li>);
    }

    return $root;
  }

  protected function getGuideCategory(
    GuidesProduct $product,
    string $guide,
  ): string {
    $path = GuidesIndex::getFileForCategory($product, $guide);
    if (file_get_contents($path)) {
      return file_get_contents($path);
    }
    return '';
  }

  protected function getGuideSummary(
    GuidesProduct $product,
    string $guide,
  ): ?x\node {
    $path = GuidesIndex::getFileForSummary($product, $guide);
    if (file_get_contents($path)) {
      return <x:frag>{file_get_contents($path)}</x:frag>;
    }
    return NULL;
  }

  <<__Override>>
  protected async function getBodyAsync(): Awaitable<x\node> {
    return
      <x:frag>
        <div class="guideListWrapper">
          <h2 class="listTitle">Hack</h2>
          {$this->getInnerContent(GuidesProduct::HACK)}
          <h3 class="listTitle">
            <a href="/hack/reference/">Hack API Reference</a>
          </h3>
          <p>Full reference docs for all functions, classes, interfaces, and traits in the Hack language.</p>
          <h3 class="listTitle">
            <a href="/hsl/reference/">Hack Standard Library Reference</a> and <a
              href="/hsl-experimental/reference/">Experimental Additions</a>
          </h3>
          <p>Full reference docs for all functions, classes, interfaces, and traits in the Hack Standard Library (HSL).</p>
        </div>
        <div class="guideListWrapper">
          <h2 class="listTitle">HHVM</h2>
          {$this->getInnerContent(GuidesProduct::HHVM)}
        </div>
      </x:frag>;
  }
}
