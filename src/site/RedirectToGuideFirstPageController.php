<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\URLBuilder;

final class RedirectToGuideFirstPageController extends WebController {
  public async function respond(): Awaitable<void> {
    $product = GuidesProduct::assert($this->getRequiredStringParam('product'));
    $guide = $this->getRequiredStringParam('guide');
    $path = self::invariantTo404(() ==> {
      $pages = GuidesIndex::getPages($product, $guide);
      $page = $pages[0];
      return URLBuilder::getPathForGuidePage($product, $guide, $page);
    });
    throw new RedirectException($path);
  }
}
