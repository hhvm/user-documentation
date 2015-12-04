<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use \Psr\Http\Message\ResponseInterface;

abstract class PageLoader {
  <<__Memoize>>
  public static function get(): PageLoader {
    return new LocalPageLoader();
  }

  public static function getPage(string $path): Awaitable<ResponseInterface> {
    return self::get()->getPageImpl($path);
  }

  abstract protected function getPageImpl(
    string $path,
  ): Awaitable<ResponseInterface>;
}
