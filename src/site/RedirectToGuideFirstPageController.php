<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;

final class RedirectToGuideFirstPageController extends WebController {
  public async function respond(): Awaitable<void> {
    $product = $this->getRequiredStringParam('product');
    $guide = $this->getRequiredStringParam('guide');
    $path = self::invariantTo404(() ==> {
      $pages = GuidesIndex::getPages($product, $guide);
      $page = $pages[0];
      return sprintf('/%s/%s/%s', $product, $guide, $page);
    });
    throw new RedirectException($path);
  }
}
