<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\APILegacyRedirectData;

require_once(BuildPaths::APIDOCS_LEGACY_REDIRECTS);

final class APILegacyRedirectController extends WebController {
  public async function respond(): Awaitable<void> {
    $id = $this->getRequiredStringParam('legacy_id');
    $url = idx(APILegacyRedirectData::getIndex(), $id);
    if ($url) {
      throw new RedirectException($url);
    }
    throw new HTTPNotFoundException();
  }
}
