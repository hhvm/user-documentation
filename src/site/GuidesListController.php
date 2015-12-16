<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\HTMLFileRenderable;
use HHVM\UserDocumentation\URLBuilder;

final class GuidesListController extends WebPageController {
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
          <p>
            Full reference docs for all functions, classes, interfaces, and
            traits in the Hack language.
          </p>
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

    $parents = Map {
      $product => URLBuilder::getPathForProductGuides($product),
    };

    return <ui:breadcrumbs parents={$parents} currentPage="Learn" />;
  }

  <<__Memoize>>
  private function getProduct(): GuidesProduct {
    return GuidesProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
