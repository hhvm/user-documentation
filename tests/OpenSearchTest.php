<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;

/**
 * @group remote
 * @small
 */
final class OpenSearchTest extends \Facebook\HackTest\HackTest {
  public async function testNoOpenSearchOnStaging(): Awaitable<void> {
    list($response, $body) =
      await PageLoader::getPageAsync('https://staging.docs.hhvm.com/');
    expect($response->getStatusCode())->toBeSame(200);
    expect($body)->toNotContain('application/opensearchdescription+xml');
  }

  public async function testOpenSearchOnProd(): Awaitable<void> {
    list($response, $body) =
      await PageLoader::getPageAsync('https://docs.hhvm.com/');
    expect($response->getStatusCode())->toBeSame(200);
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
      'Search term' => tuple('=>foobar', '/search?term=%3D%3Efoobar'),
      'Special attribute' =>
        tuple('__memoize', '/hack/attributes/special#__memoize'),
    ];
  }

  <<DataProvider('jumpProvider')>>
  public async function testJump(string $keyword, string $to): Awaitable<void> {
    $jump_url = '/j/'.$keyword;

    list($response, $body) = await PageLoader::getPageAsync($jump_url);
    expect($response->getStatusCode())->toBeSame(301);

    $target = $response->getHeaderLine('Location');
    expect($target)->toNotBeEmpty('no location header');

    expect($target)->toBeSame($to);
  }

}
