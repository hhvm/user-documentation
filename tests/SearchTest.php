<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use function Facebook\FBExpect\expect;

/**
 * @small
 */
final class SearchTest extends \PHPUnit_Framework_TestCase {
  /**
   * @dataProvider expectedResults
   */
  public function testSearchTerm(
    string $term,
    array<string> $expected,
  ): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('/search?term='.\urlencode($term))
    );
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();
    foreach ($expected as $substr) {
      expect($body)->toContain($substr);
    }
  }

  public function expectedResults(): array<(string, array<string>)> {
    return [
      tuple(
        'array_filter',
        ['http://php.net/manual/en/function.array-filter.php'],
      ),
      tuple(
        'mysqli',
        ['http://php.net/manual/en/class.mysqli.php'],
      ),
      tuple(
        'vw',
        [
          '/hack/reference/function/HH.Asio.vw/',
        ],
      ),
      tuple(
        'HH\Asio\vw',
        [
          '/hack/reference/function/HH.Asio.vw/',
        ],
      ),
      tuple(
        'async',
        ['/hack/async/introduction'],
      ),
      tuple(
        'string contains',
        [
          'HH\\Lib\\Str\\contains',
          'HH\\Lib\\Str\\contains_ci',
        ]
      ),
      tuple(
        'vector contains',
        [
          'HH\\Lib\\C\\contains',
        ]
      ),
      tuple(
        'vector contains',
        [
          'HH\\Lib\\C\\contains',
        ]
      ),
      tuple(
        'set contains',
        [
          'HH\\Lib\\C\\contains',
          'HH\\Lib\\C\\contains_key',
        ]
      ),
      tuple(
        'keyset contains',
        [
          'HH\\Lib\\C\\contains',
          'HH\\Lib\\C\\contains_key',
        ]
      ),
    ];
  }
}
