<?hh // strict

use HHVM\UserDocumentation\LegacyRedirects;
use Psr\Http\Message\ResponseInterface;

final class LegacyRedirectController
extends WebController
implements RoutableGetController {
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/manual/en/')
      ->string('legacy_id')
      ->literal('.php');
  }

  public async function getResponse(): Awaitable<ResponseInterface> {
    $id = $this->getRequiredStringParam('legacy_id');

    $url = LegacyRedirects::getUrlForId($id);
    if ($url !== null) {
      throw new RedirectException($url);
    }

    throw new HTTPNotFoundException();
  }
}
