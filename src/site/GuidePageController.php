<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesNavData;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\HTMLFileRenderable;

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
      </div>;
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
