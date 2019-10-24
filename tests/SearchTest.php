<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;

/**
 * @small
 */
final class SearchTest extends \Facebook\HackTest\HackTest {
  <<DataProvider('expectedResults')>>
  public async function testSearchTerm(
    string $term,
    array<string> $expected,
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync(
      '/search?term='.\urlencode($term),
    );
    expect($response->getStatusCode())->toBeSame(200);
    foreach ($expected as $substr) {
      expect($body)->toContainSubstring($substr);
    }
  }

  public function expectedResults(): array<(string, array<string>)> {
    return [
      tuple('vw', ['/hack/reference/function/HH.Asio.vw/']),
      tuple('HH\Asio\vw', ['/hack/reference/function/HH.Asio.vw/']),
      tuple('async', ['/hack/asynchronous-operations/introduction']),
      tuple(
        'string contains',
        ['HH\\Lib\\Str\\contains', 'HH\\Lib\\Str\\contains_ci'],
      ),
      tuple('vector contains', ['HH\\Lib\\C\\contains']),
      tuple('vector contains', ['HH\\Lib\\C\\contains']),
      tuple(
        'set contains',
        ['HH\\Lib\\C\\contains', 'HH\\Lib\\C\\contains_key'],
      ),
      tuple(
        'keyset contains',
        ['HH\\Lib\\C\\contains', 'HH\\Lib\\C\\contains_key'],
      ),
      tuple('reified', ['/hack/generics/reified-generics']),
    ];
  }
}
