<?hh // strict

use HHVM\UserDocumentation\LegacyRedirects;
use Psr\Http\Message\ResponseInterface;

final class LegacyRedirectController
extends WebController
implements RoutableGetController {
  use LegacyRedirectControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/manual/en/')
      ->string('LegacyId')
      ->literal('.php');
  }

  public async function getResponse(): Awaitable<ResponseInterface> {
    $id = $this->getParameters()['LegacyId'];

    $url = LegacyRedirects::getUrlForId($id);
    if ($url !== null) {
      throw new RedirectException($url);
    }

    throw new HTTPNotFoundException();
  }
}
