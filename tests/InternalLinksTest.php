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
      $location = $response->getHeaderLine('Location');
      $response = \HH\Asio\join(
        PageLoader::getPage($location),
      );
    }

    $this->assertSame(
      200,
      $response->getStatusCode(),
      sprintf(
        ">>> 404: %s\n>>> Linked from:\n%s",
        $target,
        implode("\n", array_map($x ==> '>>>  - '.$x, $sources)),
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
      $response = await PageLoader::getPage(
        $response->getHeaderLine('Location')
      );
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
      $path = parse_url($url, PHP_URL_PATH);
      if ($path === null) {
        continue;
      }

      // TODO: deal with relative paths
      if (substr($path, 0, 1) !== '/') {
        continue;
      }

      $links[] = $url;
    }
    return $links;
  }
}
