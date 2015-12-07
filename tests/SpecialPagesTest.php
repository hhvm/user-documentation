<?hh // strict

namespace HHVM\UserDocumentation\Tests;

/**
 * @group remote
 * @small
 */
class SpecialPagesTest extends \PHPUnit_Framework_TestCase {
  public function notFoundPathProvider(): array<array<string>> {
    return [
      ['/_I_DO_NOT_EXIST_FOR_TESTING_'],
      ['/manual/en/_I_DO_NOT_EXIST_FOR_TESTING_.php'],
    ];
  }

  /**
   * @dataProvider notFoundPathProvider
   */
  public function testNotFoundPages(string $path): void {
    $response = \HH\Asio\join(PageLoader::getPage($path));
    $this->assertSame(404, $response->getStatusCode());
    $this->assertContains("can't be found", (string) $response->getBody());
  }

  public function redirectProvider(): array<string, (string, string)> {
    return [
      'Hack class documentation' => tuple(
        '/manual/en/class.hack.maptktv.php',
        '/hack/reference/class/Map/',
      ),
      'Hack function reference' => tuple(
        '/manual/en/hackfuncref.php',
        '/hack/reference/',
      ),
      'Guide dir => first page of guide' => tuple(
        '/hack/overview/',
        '/hack/overview/introduction',
      ),
      'PHP function documentation' => tuple(
        '/manual/en/function.parse-url.php',
        'http://php.net/manual/en/function.parse-url.php',
      ),
      'PHP article' => tuple(
        '/manual/en/mail.configuration.php',
        'http://php.net/manual/en/mail.configuration.php',
      ),
      'Beta redirect root' => tuple(
        'http://beta.docs.hhvm.com/',
        'http://docs.hhvm.com/',
      ),
      'Beta redirect page' => tuple(
        'http://beta.docs.hhvm.com/hack/reference/',
        'http://docs.hhvm.com/hack/reference/',
      ),
    ];
  }

  /**
   * @dataProvider redirectProvider
   */
  public function testRedirects(string $from, string $to): void {
    $response = \HH\Asio\join(PageLoader::getPage($from));
    $this->assertSame(301, $response->getStatusCode());

    $target = $response->getHeaderLine('Location');
    $this->assertNotEmpty($target, 'no location header');

    $this->assertSame($to, $target);
  }
}
