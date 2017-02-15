<?hh // strict

use Facebook\HackRouter\SupportsGetRequests;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\GuidesProduct;
use HHVM\UserDocumentation\URLBuilder;
use Psr\Http\Message\ResponseInterface;

final class RedirectToGuideFirstPageController
extends WebController implements RoutableGetController {
  use RedirectToGuideFirstPageControllerParametersTrait;
  
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->guidesProduct('Product')
      ->literal('/')
      ->string('Guide')
      ->literal('/');
  }

  public async function getResponse(): Awaitable<ResponseInterface> {
    $params = $this->getParameters();
    $product = GuidesProduct::assert($params->getProduct());
    $guide = $params->getGuide();
    $path = self::invariantTo404(() ==> {
      $pages = GuidesIndex::getPages($product, $guide);
      $page = $pages[0];
      return URLBuilder::getPathForGuidePage($product, $guide, $page);
    });
    throw new RedirectException($path);
  }
}
