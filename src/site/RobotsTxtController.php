<?hh // strict

use HHVM\UserDocumentation\LocalConfig;

final class RobotsTxtController extends WebController {
  const string DO_NOT_CRAWL_FILE =
    LocalConfig::ROOT.'/public/robots.txt-do-not-crawl';
  const string DEFAULT_FILE =
    LocalConfig::ROOT.'/public/robots.txt-default';

  public async function respond(): Awaitable<void> {
    if ($this->getRequestedHost() === 'docs.hhvm.com') {
      $source = self::DEFAULT_FILE;
    } else {
      $source = self::DO_NOT_CRAWL_FILE;
    }
    header('Content-type: text/plain');
    print file_get_contents($source);
  }
}
