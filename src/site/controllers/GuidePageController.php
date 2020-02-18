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
  GuidesNavData,
  GuidesProduct,
  HTMLFileRenderable,
  NavDataNode,
  PaginationDataNode,
  UIGlyphIcon,
  URLBuilder,
};

use function HHVM\UserDocumentation\type_alias_structure;

use namespace Facebook\{TypeAssert, TypeSpec};
use namespace HH\Lib\{C, Dict};

final class GuidePageController extends WebPageController {
  use GuidePageControllerParametersTrait;

  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->guidesProduct('Product')
      ->literal('/')
      ->string('Guide')
      ->literal('/')
      ->string('Page');
  }

  <<__Memoize>>
  private function getProduct(): GuidesProduct {
    return $this->getParameters()['Product'];
  }

  <<__Memoize>>
  private function getGuide(): string {
    return $this->getParameters()['Guide'];
  }

  <<__Memoize>>
  private function getPage(): string {
    return $this->getParameters()['Page'];
  }

  <<__Override>>
  protected async function beforeResponseAsync(): Awaitable<void> {
    $params = $this->getParameters();
    $redirect_to = Guides::getGuidePageRedirects(
      $params['Product'],
    )[$params['Guide']][$params['Page']] ??
      Guides::getGuideRedirects($params['Product'])[$params['Guide']] ??
      null;

    if ($redirect_to === null) {
      return;
    }
    list($guide, $page) = $redirect_to;
    $page = $page ??
      C\firstx(GuidesIndex::getPages($params['Product'], $guide));
    throw new RedirectException(GuidePageControllerURIBuilder::getPath(shape(
      'Product' => $params['Product'],
      'Guide' => $guide,
      'Page' => $page,
    )));
  }

  <<__Override>>
  public async function getTitleAsync(): Awaitable<string> {
    list($product, $guide, $page) = tuple(
      $this->getProduct(),
      $this->getGuide(),
      $this->getPage(),
    );
    return self::invariantTo404(
      () ==> Guides::normalizeName($product, $guide, $page),
    );
  }

  <<__Override>>
  protected async function getBodyAsync(): Awaitable<XHPRoot> {
    return
      <div class="guidePageWrapper">
        {$this->getInnerContent()}
        {$this->getPaginationLinks()}
      </div>;
  }

  protected function getPaginationLinks(): XHPRoot {
    list($product, $guide, $page) = tuple(
      $this->getProduct(),
      GuidesNavData::pathToName($this->getGuide()),
      GuidesNavData::pathToName($this->getPage()),
    );

    $paging = <div class="paginationLinks" />;
    $nav_data = GuidesNavData::getNavData()[$product]['children']
      |> TypeSpec\dict(
        TypeSpec\string(),
        TypeSpec\__Private\from_type_structure(
          type_alias_structure(NavDataNode::class),
        ),
      )->assertType($$);

    $paging->appendChild(
      $this->getPaginationLink($nav_data, $guide, $page, false),
    );
    $paging->appendChild(
      $this->getPaginationLink($nav_data, $guide, $page, true),
    );
    return $paging;
  }

  protected function getPaginationLink(
    dict<string, NavDataNode> $guides,
    string $guide,
    string $page,
    bool $next = false,
  ): XHPRoot {
    $adjacent_page = $this->getAdjacentPage($guides, $guide, $page, $next);

    if ($adjacent_page === null) {
      return <x:frag />;
    }
    $page = $adjacent_page['page'];
    $guide = $adjacent_page['guide'];

    $guide_title = $guide[0];
    $page_title = <x:frag />;
    if ($guide_title !== $page[0]) {
      $guide_title .= ':';
      $page_title =
        <span class="paginationPageTitle">
          {$page[0]}
        </span>;
    }

    $class = "paginationLink ";
    $class = $class.($next ? "next" : "previous");

    if ($next) {
      $align = 'right';
      $glyph = UIGlyphIcon::RIGHT;
    } else {
      $align = 'left';
      $glyph = UIGlyphIcon::LEFT;
    }

    return
      <div class={$class}>
        <ui:button
          align={$align}
          href={$page[1]['urlPath']}
          glyph={$glyph}
          size="medium">
          {$page_title}
          <span class="paginationGuideTitle">
            {$guide_title}
          </span>
        </ui:button>
      </div>;
  }

  protected function getAdjacentPage(
    dict<string, NavDataNode> $guides,
    string $guide,
    string $page,
    bool $next = false,
  ): ?PaginationDataNode {
    $sibling_pages = $guides[$guide]['children'];
    $sibling_pages = $next ? array_reverse($sibling_pages) : $sibling_pages;
    $adjacent_page = null;

    // Gets last page if next = true, first page if previous (next = false)
    $head_page = C\first_key($sibling_pages);

    if ($page === $head_page) {
      $adj = $this->getAdjacentGuide($guides, $guide, $next);
      if ($adj !== null) {
        list($adjacent_guide, $adjacent_guide_data) = $adj;
        $guide_pages = $adjacent_guide_data['children'];
        $guide_pages = $next ? $guide_pages : array_reverse($guide_pages);
        $adjacent_page = shape(
          'page' => tuple(C\first_keyx($guide_pages), C\firstx($guide_pages)),
          'guide' => tuple($adjacent_guide, $adjacent_guide_data),
        );
      }
    } else {
      foreach ($sibling_pages as $sibling => $sibling_data) {
        if ($sibling === $page) {
          break;
        }
        $adjacent_page = shape(
          'page' => tuple($sibling, $sibling_data),
          'guide' => tuple($guide, $guides[$guide]),
        );
      }
    }
    return $adjacent_page;
  }

  protected function getAdjacentGuide(
    dict<string, NavDataNode> $guides,
    string $current_guide,
    bool $next = false,
  ): ?(string, NavDataNode) {
    $adj_guide = null;
    $guides = $next ? array_reverse($guides) : $guides;
    foreach ($guides as $guide => $data) {
      if ($guide === $current_guide) {
        break;
      }
      $adj_guide = tuple($guide, $data);
    }
    return $adj_guide;
  }

  <<__Override>>
  protected function getBreadcrumbs(): vec<(string, ?string)> {
    $product = $this->getProduct();
    $product_url = URLBuilder::getPathForProductGuides($product);
    $guide = $this->getGuide();
    $page = Guides::normalizePart($this->getPage());

    return vec[
      tuple($product, $product_url),
      tuple('Learn', $product_url),
      tuple(
        Guides::normalizePart($guide),
        URLBuilder::getPathForGuide($product, $guide),
      ),
      tuple($page, null),
    ];
  }

  <<__Override>>
  protected function getSideNav(): XHPRoot {
    $ts = type_alias_structure(NavDataNode::class);
    $data = Dict\map(
      GuidesNavData::getNavData()[$this->getProduct()]['children'],
      $child ==> TypeAssert\matches_type_structure($ts, $child),
    );
    return (
      <ui:navbar
        data={$data}
        activePath={vec[
          GuidesNavData::pathToName($this->getGuide()),
          GuidesNavData::pathToName($this->getPage()),
        ]}
      />
    );
  }

  protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = GuidesIndex::getFileForPage(
        $this->getProduct(),
        $this->getGuide(),
        $this->getPage(),
      );
      return <div class="innerContent">{new HTMLFileRenderable($path)}</div>;
    });
  }
}
