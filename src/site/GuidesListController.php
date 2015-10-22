<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\HTMLFileRenderable;

enum GuideProduct: string as string {
  HHVM = 'hhvm';
  HACK = 'hack';
}

final class GuidesListController extends WebPageController {  
  protected async function getTitle(): Awaitable<string> {
    switch ($this->getProduct()) {
      case GuideProduct::HHVM:
        return 'HHVM Documentation';
      case GuideProduct::HACK:
        return 'Hack Documentation';
    }
  }
  
  protected function getInnerContent(): XHPRoot {
    $product = $this->getProduct();
    $guides = GuidesIndex::getGuides($product);

    $root = <ul class="guideList" />;
    foreach ($guides as $guide) {
      $pages = GuidesIndex::getPages($product, $guide);
      $url = sprintf(
        "/%s/%s/%s",
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
            <a href="/hack/reference/">API Reference</a>
          </h3> 
          <p>Full reference docs for all functions, classes, interfaces, and traits in the Hack language.</p>
        </div>
      );
    }
    return $body;
  }
  
  protected function getGuideSummary(string $guide): ?XHPRoot {
    $path = GuidesIndex::getFileForSummary(
      $this->getRequiredStringParam('product'),
      $guide,
    );
    if (file_get_contents($path)) {
      return <x:frag>{file_get_contents($path)}</x:frag>;
    }
    return NULL;
  }
  
  protected function getBreadcrumbs(): XHPRoot {
    $product = $this->getProduct();
    $product_root_url = sprintf(
      "/%s/",
      $product,
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
          <span class="breadcrumbCurrentPage">Learn</span>
        </div>
      </div>;
  }

  <<__Memoize>>
  private function getProduct(): GuideProduct {
    return GuideProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
