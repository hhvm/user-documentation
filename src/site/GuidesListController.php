<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;

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
            {file_get_contents('http://loripsum.net/api/1/veryshort/plaintext')}
          </div>
        </li>
      );
    }
    return $root;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return 
      <div class="guideListWrapper">
        <h3 class="listTitle">Learn</h3>
        {$this->getInnerContent()}
      </div>;
  }

  <<__Memoize>>
  private function getProduct(): GuideProduct {
    return GuideProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
