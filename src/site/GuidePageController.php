<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesNavData;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\HTMLFileRenderable;
use HHVM\UserDocumentation\NavDataNode;
use HHVM\UserDocumentation\PaginationDataNode;

use Psr\Http\Message\ServerRequestInterface;

final class GuidePageController extends WebPageController {

  <<__Memoize>>
  private function getProduct(): GuidesProduct {
    return GuidesProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }

  <<__Memoize>>
  private function getGuide(): string {
    return $this->getRequiredStringParam('guide');
  }

  <<__Memoize>>
  private function getPage(): string {
    return $this->getRequiredStringParam('page');
  }

  public async function getTitle(): Awaitable<string> {
    list($product, $guide, $page) = tuple(
      $this->getProduct(),
      $this->getGuide(),
      $this->getPage(),
    );
    // If the guide name and the page name are the same, only print one of them.
    // If there is only one page in a guide, only print the guide name.
    $ret = strcasecmp($guide, $page) === 0 ||
           count(GuidesIndex::getPages($product, $guide)) === 1
         ? ucwords(strtr($guide, '-', ' '))
         : ucwords(strtr($guide.': '.$page, '-', ' '));
    return $ret;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
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
    $nav_data = GuidesNavData::getNavData()[$product]['children'];
    
    if (is_array($nav_data)) {      
      $paging->appendChild(
        $this->getPaginationLink($nav_data, $guide, $page, false)
      );     
      $paging->appendChild(
        $this->getPaginationLink($nav_data, $guide, $page, true)
      );
    }
    return $paging;
  }
  
  protected function getPaginationLink(
    array<string, NavDataNode> $guides,
    string $guide,
    string $page,
    bool $next = false,
  ): XHPRoot {
    $adjacent_page = $this->getAdjacentPage($guides, $guide, $page, $next);
    
    if (is_array($adjacent_page)) {
      $page = $adjacent_page['page'];
      $guide = $adjacent_page['guide'];
      
      $title = sprintf(
        "%s: %s",
        array_keys($guide)[0],
        array_keys($page)[0],
      );
      
      $class = "paginationLink ";
      $class = $class.($next ? "next" : "previous");

      if ($next) {
        $title = $title.' »';
      } else {
        $title = '« '.$title;
      }
      
      return 
        <div class={$class}>
          <a href={array_values($page)[0]['urlPath']}>
            {$title}
          </a>
        </div>;
    }
    
    return <x:frag />;
  }
  
  protected function getAdjacentPage(
    array<string, NavDataNode> $guides,
    string $guide,
    string $page,
    bool $next = false,
  ): ?PaginationDataNode {
    $sibling_pages = $guides[$guide]['children'];
    $sibling_pages = $next ? array_reverse($sibling_pages) : $sibling_pages;
    $adjacent_page = null;
    
    // Gets last page if next = true, first page if previous (next = false)
    reset($sibling_pages);
    $head_page = key($sibling_pages);
    
    if ($page === $head_page) {
      list($adjacent_guide, $adjacent_guide_data) = 
        $this->getAdjacentGuide($guides, $guide, $next);
      if ($adjacent_guide_data !== null) {
        $guide_pages = $adjacent_guide_data['children'];
        $guide_pages = $next ? $guide_pages : array_reverse($guide_pages); 
        $adjacent_data = reset($guide_pages);
        $adjacent_page = shape(
          'page' => array(key($guide_pages) => $adjacent_data),
          'guide' => array($adjacent_guide => $adjacent_guide_data),
        );
      }
    } else {
      foreach($sibling_pages as $sibling => $sibling_data) {
        if ($sibling === $page) {
          break;
        }
        $adjacent_page = shape(
          'page' => array($sibling => $sibling_data),
          'guide' => array($guide => $guides[$guide]),
        );
      }
    }
    return $adjacent_page;
  }
  
  protected function getAdjacentGuide(
    array<string, NavDataNode> $guides,
    string $current_guide,
    bool $next = false,
  ): (?string, ?NavDataNode) {
    $adj_guide = tuple(null, null);
    $guides = $next ? array_reverse($guides) : $guides;
    foreach($guides as $guide => $data) {
      if ($guide === $current_guide) {
        break;
      }
      $adj_guide = tuple($guide, $data);
    }
    return $adj_guide;
  }

  protected function getBreadcrumbs(): XHPRoot {
    $product = $this->getProduct();
    $guide = $this->getGuide();
    $product_root_url = sprintf(
      "/%s/",
      $product,
    );
    $guide_root_url = sprintf(
      "/%s/%s/",
      $product,
      $guide,
    );

    return
      <div class="breadcrumbNav">
        <div class="widthWrapper">
          <span class="breadcrumbRoot">
            <a href="/">Documentation</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbProductRoot">
            <a href={$product_root_url}>{$product}</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbSecondaryRoot">
            <a href={$product_root_url}>Learn</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbCurrentPage">
            {ucwords(strtr($guide.': '.$this->getPage(), '-', ' '))}
          </span>
        </div>
      </div>;
  }

  protected function getSideNav(): XHPRoot {
    $product = $this->getProduct();
    $nav_args = [
      'data' => GuidesNavData::getNavData()[$product]['children'],
      'activePath' => [
        GuidesNavData::pathToName($this->getGuide()),
        GuidesNavData::pathToName($this->getPage()),
      ],
      'extraNavListClass' => '',
    ];
    return
      <div class="navWrapper guideNav">
        <div class="navLoader" />
        <static:script path="/js/UnifiedSideNav.js" />
        <script>
          var navLoader = document.getElementsByClassName('navLoader')[0];
          ReactDOM.render(
            React.createElement(DocNav, {json_encode($nav_args)}), 
            navLoader
          );
        </script>
      </div>;
  }

  protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = GuidesIndex::getFileForPage(
        GuidesProduct::assert($this->getRequiredStringParam('product')),
        $this->getRequiredStringParam('guide'),
        $this->getRequiredStringParam('page'),
      );
      return
        <div class="innerContent">{new HTMLFileRenderable($path)}</div>;
    });
  }
}
