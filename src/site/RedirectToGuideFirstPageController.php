<?hh // strict

use FredEmmott\HackRouter\SupportsGetRequests;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\URLBuilder;
use Psr\Http\Message\ResponseInterface;

final class RedirectToGuideFirstPageController
extends WebController implements RoutableGetController {
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->guidesProduct('product')
      ->literal('/')
      ->string('guide')
      ->literal('/');
  }

  public async function getResponse(): Awaitable<ResponseInterface> {
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
