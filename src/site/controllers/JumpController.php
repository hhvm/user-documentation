<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\JumpIndexData;
use Psr\Http\Message\ResponseInterface;

require_once(BuildPaths::JUMP_INDEX);

final class JumpController
extends WebController
implements RoutableGetController {
  use JumpControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/j/')
      ->string('Keyword');
  }

  public function getResponse(): Awaitable<ResponseInterface> {
    $keyword = $this->getParameters()['Keyword'];

    $data = JumpIndexData::getIndex();
    $url = idx($data, strtolower($keyword));
    if (is_string($url)) {
      throw new RedirectException($url);
    }

    throw new RedirectException(
      '/search?term='.urlencode($keyword)
    );
  }
}
