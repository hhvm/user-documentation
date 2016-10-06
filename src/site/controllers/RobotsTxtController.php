<?hh // strict

use HHVM\UserDocumentation\LocalConfig;
use Psr\Http\Message\ResponseInterface;

final class RobotsTxtController
extends WebController
implements RoutableGetController {
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())->literal('/robots.txt');
  }

  const string DO_NOT_CRAWL_FILE =
    LocalConfig::ROOT.'/public/robots.txt-do-not-crawl';
  const string DEFAULT_FILE =
    LocalConfig::ROOT.'/public/robots.txt-default';

  public async function getResponse(): Awaitable<ResponseInterface> {
    if ($this->getRequestedHost() === 'docs.hhvm.com') {
      $source = self::DEFAULT_FILE;
    } else {
      $source = self::DO_NOT_CRAWL_FILE;
    }

    return Response::newWithStringBody(file_get_contents($source))
      ->withAddedHeader('Content-Type', 'text/plain');
  }
}
