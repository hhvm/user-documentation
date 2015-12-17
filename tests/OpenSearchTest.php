<?hh // strict

namespace HHVM\UserDocumentation\Tests;

/**
 * @group remote
 * @small
 */
final class OpenSearchTest extends \PHPUnit_Framework_TestCase {
  public function testNoOpenSearchOnStaging(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('https://staging.docs.hhvm.com/')
    );
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();
    $this->assertNotContains('application/opensearchdescription+xml', $body);
  }

  public function testOpenSearchOnProd(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('https://docs.hhvm.com/')
    );
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();
    $this->assertContains('application/opensearchdescription+xml', $body);
  }

  public function jumpProvider(): array<string, (string, string)> {
    return [
      'Hack class without namespace' => tuple(
        'ResultOrExceptionWrapper',
        '/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/',
      ),
      'Hack class with namespace' => tuple(
        'HH\Asio\ResultOrExceptionWrapper',
        '/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/',
      ),
      'Hack class with bad capitalization' => tuple(
        'resultorexceptionwrapper',
        '/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/',
      ),
      'PHP function' => tuple(
        'array_filter',
        'http://php.net/manual/en/function.array-filter.php',
      ),
      'Search term' => tuple(
        '=>foobar',
        '/search?term=%3D%3Efoobar',
      ),
      'Special attribute' => tuple(
        '__memoize',
        '/hack/attributes/special#__memoize',
      ),
    ];
  }

  /**
   * @dataProvider jumpProvider
   */
  public function testJump(string $keyword, string $to): void {
    $jump_url= '/j/'.$keyword;

    $response = \HH\Asio\join(PageLoader::getPage($jump_url));
    $this->assertSame(301, $response->getStatusCode());

    $target = $response->getHeaderLine('Location');
    $this->assertNotEmpty($target, 'no location header');

    $this->assertSame($to, $target);
  }

}
