<?hh // strict

namespace HHVM\UserDocumentation\Tests;

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
      PageLoader::getPage('/search?term='.urlencode($term))
    );
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();
    foreach ($expected as $url) {
      $this->assertContains($url, $expected);
    }
  }

  public function expectedResults(): array<(string, array<string>)> {
    return [
      tuple(
        'array_filter',
        ['http://php.net/manual/en/class.mysqli.php'],
      ),
      tuple(
        'mysqli',
        ['http://php.net/manual/en/function.array_filter.php'],
      ),
      tuple(
        'vw',
        [
          '/hack/async/utility-functions',
          '/hack/reference/function/HH.Asio.vw/',
        ],
      ),
      tuple(
        'HH\Asio\vw',
        [
          '/hack/async/utility-functions',
          '/hack/reference/function/HH.Asio.vw/',
        ],
      ),
      tuple(
        'async',
        ['/hack/async/introduction'],
      ),
    ];
  }
}
