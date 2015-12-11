<?hh

namespace HHVM\UserDocumentation\Tests;

/**
 * @large
 */
final class InternalLinksTest extends \PHPUnit_Framework_TestCase {

  /**
   * @dataProvider internalLinksList
   */
  public function testInternalLink(
    string $target,
    array<string> $sources,
  ): void {
    $response = \HH\Asio\join(
      PageLoader::getPage($target)
    );
    if ($response->getStatusCode() === 301) {
      $target = $response->getHeaderLine('Location');
      $response = \HH\Asio\join(
        PageLoader::getPage($target),
      );
    }

    $sources = new Set($sources);

    $this->assertSame(
      200,
      $response->getStatusCode(),
      sprintf(
        ">>> 404: %s\n>>> Linked from:\n%s",
        $target,
        implode("\n", $sources->map($x ==> '>>>  - '.$x)),
      ),
    );
  }

  public function testCanGetLinksList(): void {
    $_ = $this->internalLinksList();
  }

  <<__Memoize>>
  public function internalLinksList(
  ): array<(string, array<string>)> {
    $loaders = Map { };

    $api_pages = APIPagesTest::allAPIPages();
    foreach ($api_pages as $call) {
      list($_, $node) = $call;
      $url = $node['urlPath'];
      $loaders[$url] = $this->getInternalLinksOnPage($url);
    }

    $guide_pages = GuidePagesTest::allGuidePages();
    foreach ($guide_pages as $call) {
      list($_, $url) = $call;
      $loaders[$url] = $this->getInternalLinksOnPage($url);
    }

    $urls = \HH\Asio\join(\HH\Asio\m($loaders));

    $targets_to_sources = Map { };
    foreach ($urls as $source => $targets) {
      foreach ($targets as $target) {
        if (!$targets_to_sources->containsKey($target)) {
          $targets_to_sources[$target] = [];
        }
        $targets_to_sources[$target][] = $source;
      }
    }

    $ret = [];
    foreach ($targets_to_sources as $target => $sources) {
      $ret[] = tuple($target, $sources);
    }

    return $ret;
  }

  private async function getInternalLinksOnPage(
    string $page,
  ): Awaitable<Vector<string>> {
    $response = await PageLoader::getPage($page);

    if ($response->getStatusCode() === 301) {
      $page = $response->getHeaderLine('Location');
      $response = await PageLoader::getPage($page);
    }

    $this->assertSame(200, $response->getStatusCode(), $page);

    $dom = new \DOMDocument();
    libxml_use_internal_errors(true); // No support for HTML5 tags
    $dom->loadHTML($response->getBody());
    libxml_clear_errors();
    $xpath = new \DOMXPath($dom);
    $hrefs = $xpath->query('//a/@href');

    $links = Vector { };
    foreach ($hrefs as $node) {
      $url = $node->value;

      $host = parse_url($url, PHP_URL_HOST);
      if ($host !== null) {
        continue;
      }

      $path = $this->normalizePath($page, parse_url($url, PHP_URL_PATH));
      if ($path === null) {
        continue;
      }

      $links[] = $path;
    }
    return $links;
  }

  private function normalizePath(string $source, ?string $path): ?string {
    if ($path === null) {
      return $path;
    }

    if ($path[0] === '/') {
      return $path;
    }

    /** FIXME: https://github.com/hhvm/user-documentation/issues/200
    $context = dirname($source);
    if (substr($path, 0, 2) === './') {
      $path = $context.substr($path, 1);
      return $path;
    }
    */

    return null;
  }
}
