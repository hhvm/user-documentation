<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type \Psr\Http\Message\ResponseInterface;

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

  public static function getPageAsync(string $url): Awaitable<ResponseInterface> {
    return self::get()->getPageImplAsync($url);
  }

  abstract protected function getPageImplAsync(
    string $url,
  ): Awaitable<ResponseInterface>;

  <<__Memoize>>
  protected static function getHost(): ?string {
    $host = \getenv('REMOTE_TEST_HOST');
    if ($host === false) {
      return null;
    }
    return (string) $host;
  }

  public static function assertLocal(): void {
    // Work around sebastianbergmann/phpunit#2007
    invariant(
      self::getHost() === null,
      'Local only test running against remote server',
    );
  }
}
