<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\HTMLFileRenderable;

use Psr\Http\Message\ServerRequestInterface;

final class GuidePageController extends WebPageController {
  protected string $guide;
  protected string $page;

  public function __construct(
    private ImmMap<string,string> $parameters,
    ServerRequestInterface $request,
  ) {
    parent::__construct($parameters, $request);
    $this->guide = $parameters->at('guide');
    $this->page = $parameters->at('page');
  }

  public async function getTitle(): Awaitable<string> {
    // If the guide name and the page name are the same, only print one of them.
    // If there is only one page in a guide, only print the guide name.
    $ret = strcasecmp($this->guide, $this->page) === 0 ||
           count(GuidesIndex::getPages($this->getProduct(), $this->guide)) === 1
         ? ucwords(strtr($this->guide, '-', ' '))
         : ucwords(strtr($this->guide.': '.$this->page, '-', ' '));
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
    $guide = $this->guide;
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
            {ucwords(strtr($guide.': '.$this->page, '-', ' '))}
          </span>
        </div>
      </div>;
  }
  
  protected function getSideNav(): XHPRoot {
    $product = $this->getProduct();
    $guides = GuidesIndex::getProductIndex($product);
    return 
      <div class="navWrapper guideNav">
        <div class="navLoader"></div>
        <script>
          var docnavData = {json_encode($guides)};
          var thisDoc = "{$this->page}";
          var thisGroup = "{$this->guide}";
          var thisProduct = "{$product}";
        </script>
        <script type="text/babel" src="/js/SideNav.js"></script>
      </div>;
  }

  protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = GuidesIndex::getFileForPage(
        $this->getRequiredStringParam('product'),
        $this->getRequiredStringParam('guide'),
        $this->getRequiredStringParam('page'),
      );
      return
        <div class="innerContent">{new HTMLFileRenderable($path)}</div>;
    });
  }

  <<__Memoize>>
  private function getProduct(): GuideProduct {
    return GuideProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
