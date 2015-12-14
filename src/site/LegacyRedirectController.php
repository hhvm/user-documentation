<?hh // strict

use HHVM\UserDocumentation\LegacyRedirects;
use Psr\Http\Message\ResponseInterface;

final class LegacyRedirectController extends WebController {
  public async function getResponse(): Awaitable<ResponseInterface> {
    $id = $this->getRequiredStringParam('legacy_id');

    $url = LegacyRedirects::getUrlForId($id);
    if ($url !== null) {
      throw new RedirectException($url);
    }

    throw new HTTPNotFoundException();
  }
}
