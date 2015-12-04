<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use \Psr\Http\Message\ResponseInterface;

abstract class PageLoader {
  <<__Memoize>>
  public static function get(): PageLoader {
    $host = self::getHost();
    if ($host === null) {
      return new LocalPageLoader();
    } else {
      return new RemotePageLoader();
    }
  }

  public static function getPage(string $url): Awaitable<ResponseInterface> {
    return self::get()->getPageImpl($url);
  }

  abstract protected function getPageImpl(
    string $url,
  ): Awaitable<ResponseInterface>;

  <<__Memoize>>
  protected static function getHost(): ?string {
    $host = getenv('REMOTE_TEST_HOST');
    if ($host === false) {
      return null;
    }
    return (string) $host;
  }
}
