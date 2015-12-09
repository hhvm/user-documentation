<?hh

namespace HHVM\UserDocumentation\Tests;

/**
 * @group remote
 * @small
 */
class AutoLinkifyAPITest extends \PHPUnit_Framework_TestCase {
  public function autoLinkifyExamplesProvider(
  ): array<string, (string, string, string)> {
    return [
      'PHP function' =>
        tuple(
          '/hack/async/utility-functions',
          'array_filter()',
          'http://php.net/manual/en/function.array-filter.php',
        ),
      'Hack class' =>
        tuple(
          '/hack/async/extensions',
          'MCRouter',
          '/hack/reference/class/MCRouter/',
        ),
      'Namespaced Hack function' =>
        tuple(
          '/hack/async/extensions',
          'HH\Asio\curl_exec()',
          '/hack/reference/function/HH.Asio.curl_exec/',
        ),
      'Hack fully-qualified method' =>
        tuple(
          '/hack/reference/class/AsyncMysqlConnectResult/elapsedMicros/',
          'AsyncMysqlConnection::connectResult',
          '/hack/reference/class/AsyncMysqlConnection/connectResult/',
        ),
      'Hack method with incomplete name from class doc' =>
        tuple(
          '/hack/reference/class/AsyncMysqlClient/',
          'connect()',
          '/hack/reference/class/AsyncMysqlClient/connect/',
        ),
      'Hack method with incomplete name from method doc' =>
        tuple(
          '/hack/reference/class/AsyncMysqlConnection/query/',
          'escapeString()',
          '/hack/reference/class/AsyncMysqlConnection/escapeString/',
        ),
    ];
  }

  /**
   * @dataProvider autoLinkifyExamplesProvider
   */
  public function testAutoLinkify(
    string $source,
    string $keyword,
    string $dest,
  ): void {
    $page = \HH\Asio\join(PageLoader::getPage($source));
    $body = (string) $page->getBody();

    $dom = new \DOMDocument();
    $dom->loadHTML($body);
    $xpath = new \DOMXPath($dom);

    $nodes = $xpath->query(
        '//a[@class = "autoAPILink" and @href = "'.$dest.'"]'.
        '/code[text() = "'.$keyword.'"]'
    );
    $this->assertGreaterThanOrEqual(
      1,
      $nodes->length,
      'no matches',
    );
  }
}
