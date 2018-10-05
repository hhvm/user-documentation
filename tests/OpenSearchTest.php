<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;

/**
 * @group remote
 * @small
 */
final class OpenSearchTest extends \Facebook\HackTest\HackTest {
  public function testNoOpenSearchOnStaging(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('https://staging.docs.hhvm.com/'));
    expect($response->getStatusCode())->toBeSame(200);
    $body = (string) $response->getBody();
    expect($body)->toNotContain('application/opensearchdescription+xml');
  }

  public function testOpenSearchOnProd(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('https://docs.hhvm.com/'));
    expect($response->getStatusCode())->toBeSame(200);
    $body = (string) $response->getBody();
    expect($body)->toContain('application/opensearchdescription+xml');
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

  <<DataProvider('jumpProvider')>>
  public function testJump(string $keyword, string $to): void {
    $jump_url= '/j/'.$keyword;

    $response = \HH\Asio\join(PageLoader::getPageAsync($jump_url));
    expect($response->getStatusCode())->toBeSame(301);

    $target = $response->getHeaderLine('Location');
    expect($target)->toNotBeEmpty('no location header');

    expect($target)->toBeSame($to);
  }

}
