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
    vec<string> $expected,
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync(
      '/search?term='.\urlencode($term),
    );
    expect($response->getStatusCode())->toBeSame(200);
    foreach ($expected as $substr) {
      expect($body)->toContainSubstring($substr);
    }
  }

  public function expectedResults(): vec<(string, vec<string>)> {
    return vec[
      tuple('vw', vec['/hack/reference/function/HH.Asio.vw/']),
      tuple('HH\Asio\vw', vec['/hack/reference/function/HH.Asio.vw/']),
      tuple('async', vec['/hack/asynchronous-operations/introduction']),
      tuple(
        'string contains',
        vec['HH\\Lib\\Str\\contains', 'HH\\Lib\\Str\\contains_ci'],
      ),
      tuple('vector contains', vec['HH\\Lib\\C\\contains']),
      tuple('vector contains', vec['HH\\Lib\\C\\contains']),
      tuple(
        'set contains',
        vec['HH\\Lib\\C\\contains', 'HH\\Lib\\C\\contains_key'],
      ),
      tuple(
        'keyset contains',
        vec['HH\\Lib\\C\\contains', 'HH\\Lib\\C\\contains_key'],
      ),
      tuple('reified', vec['/hack/reified-generics/reified-generics']),
      tuple('arithmetic', vec['/hack/expressions-and-operators/arithmetic']),
      tuple('type assertion', vec['/hack/expressions-and-operators/type-assertions']),
      tuple('assignment', vec['/hack/expressions-and-operators/assignment']),
      tuple('pipe', vec['/hack/expressions-and-operators/pipe']),
      tuple('bitwise', vec['/hack/expressions-and-operators/bitwise-operators']),
      tuple('coalesce', vec['hack/expressions-and-operators/coalesce']),
      tuple('comparison', vec['/hack/expressions-and-operators/comparisons']),
      tuple('concatenation', vec['/hack/expressions-and-operators/string-concatenation']),
      tuple('equality', vec['/hack/expressions-and-operators/equality']),
      tuple('suppress error', vec['/hack/expressions-and-operators/error-control']),
      tuple('increment decrement', vec['/hack/expressions-and-operators/incrementing-and-decrementing']),
      tuple('logical', vec['/hack/expressions-and-operators/logical-operators']),
      tuple('objects properties methods', vec['/hack/expressions-and-operators/member-selection']),
      tuple('precedence', vec['/hack/expressions-and-operators/operator-precedence']),
      tuple('select scope resolution', vec['/hack/expressions-and-operators/scope-resolution']),
      tuple('subscript', vec['/hack/expressions-and-operators/subscript']),
      tuple('ternary', vec['/hack/expressions-and-operators/ternary']),
    ];
  }
}
