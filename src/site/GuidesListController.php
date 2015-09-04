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

  protected async function getBody(): Awaitable<XHPRoot> {
    $product = $this->getProduct();
    $guides = GuidesIndex::getGuides($product);

    $root = <ul />;
    foreach ($guides as $guide) {
      $title = ucwords(strtr($guide, '-', ' '));
      $root->appendChild(
        <li><a href={sprintf("/%s/%s/", $product, $guide)}>{$title}</a></li>
      );
    }
    return $root;
  }

  <<__Memoize>>
  private function getProduct(): GuideProduct {
    return GuideProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
