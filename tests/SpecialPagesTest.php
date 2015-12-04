<?hh

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
}
