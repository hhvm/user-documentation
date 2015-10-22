<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\HTMLFileRenderable;

final class GuidePageController extends WebPageController {
  protected string $guide = '';
  protected string $page = '';
  
  public function __construct(
    private ImmMap<string,string> $parameters,
  ) {
    parent::__construct($parameters);
    $this->guide = $this->getRequiredStringParam('guide');
    $this->page = $this->getRequiredStringParam('page');
  }
  
  protected async function getTitle(): Awaitable<string> {
    return 
      ucwords(strtr($this->guide.': '.$this->page, '-', ' '));
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
    $guides = GuidesIndex::getGuides($product);

    $list = <ul class="navList" />;
    foreach ($guides as $guide) {
      $pages = GuidesIndex::getPages($product, $guide);
      $url = sprintf(
        "/%s/%s/%s",
        $product,
        $guide,
        $pages[0],
      );

      $title = ucwords(strtr($guide, '-', ' '));
      $sub_list = <ul class="subList" />;
      
      foreach ($pages as $page) {
        $page_url = sprintf(
          "/%s/%s/%s",
          $product,
          $guide,
          $page,
        );

        $page_title = ucwords(strtr($page, '-', ' '));
        $sub_list_item =
          <li class="subListItem">
            <h5><a href={$page_url}>{$page_title}</a></h5>
          </li>;
          
        if ($this->guide === $guide && $this->page === $page) {
          $sub_list_item->addClass("itemActive");
        }
        
        $sub_list->appendChild($sub_list_item);
      }

      $list->appendChild(
        <li>
          <h4><a href={$url}>{$title}</a></h4>
          {$sub_list}
        </li>
      );
    }
    
    return
      <div class="navWrapper guideNav">
        {$list}
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
