<?hh

namespace HHVM\UserDocumentation\Tests;

/**
 * @large
 */
final class InternalLinksTest extends \PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass(): void {
    XHPValidation::disable();
  }

  public static function tearDownAfterClass(): void {
    XHPValidation::enable();
  }

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

  public function testDoesNotBreakExternalMarkdownLinks(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('/hack/typechecker/editors')
    );
    $body = (string) $response->getBody();
    $this->assertContains('Vim users', $body);
    $this->assertContains(
      'https://github.com/hhvm/vim-hack/blob/master/README',
      $body,
    );
    $this->assertContains(
      'https://github.com/hhvm/vim-hack/blob/master/README.md',
      $body,
    );
  }

  public function testCanGetLinksList(): void {
    $_ = $this->internalLinksList();
  }

  private static ?array<(string, array<string>)> $linksCache = null;

  public function internalLinksList(
  ): array<(string, array<string>)> {
    $guard = new XHPValidationGuard();
    return $this->internalLinksListImpl();
  }
  public function internalLinksListImpl(
  ): array<(string, array<string>)> {
    PageLoader::assertLocal();
    $cached = self::$linksCache;
    if ($cached !== null) {
      return $cached;
    }

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

    self::$linksCache = $ret;
    return $ret;
  }

  <<__Memoize>>
  private async function getInternalLinksOnPage(
    string $page,
  ): Awaitable<Vector<string>> {
    PageLoader::assertLocal();

    $response = await PageLoader::getPage($page);

    if ($response->getStatusCode() === 301) {
      return await $this->getInternalLinksOnPage(
        $response->getHeaderLine('Location')
      );
    }

    $this->assertSame(200, $response->getStatusCode(), $page);

    /* HH_FIXME[2049] No DOM HHI: facebook/hhvm#5322 */
    $dom = new \DOMDocument();
    libxml_use_internal_errors(true); // No support for HTML5 tags
    $dom->loadHTML($response->getBody());
    libxml_clear_errors();
    /* HH_FIXME[2049] No DOM HHI: facebook/hhvm#5322 */
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

  public function pathNormalizationTestCases(
  ): array<(string, string, string)> {
    return [
      tuple('/foo/bar', '/baz', '/baz'),
      tuple('/foo/bar', './baz', '/foo/baz'),
      tuple('/foo/bar/', './baz', '/foo/bar/baz'),
      tuple('/foo/bar', '../baz', '/baz'),
      tuple('/foo/bar/', '../baz', '/foo/baz'),
      tuple('/foo/bar/baz/', '../../herp', '/foo/herp'),
      tuple('/foo/bar/baz', '../../herp', '/herp'),
      tuple('/foo/bar', 'herp/derp', '/foo/herp/derp'),
      tuple('/foo/bar/', 'herp/derp', '/foo/bar/herp/derp'),
    ];
  }

  /**
   * @dataProvider pathNormalizationTestCases
   *
   * Testing the test...
   */
  public function testPathNormalization(
    string $context,
    string $in,
    ?string $expected,
  ): void {
    $out = $this->normalizePath($context, $in);
    $this->assertSame($expected, $out);
  }

  private function normalizePath(string $source, ?string $path): ?string {
    if ($path === null) {
      return $path;
    }

    if ($path[0] === '/') {
      return $path;
    }

    $in_dir = substr($source, -1) === '/';

    if (substr($path, 0, 2) === './') {
      if ($in_dir) {
        // /foo/bar/ + ./baz => /foo/bar/baz
        $context = $source;
      } else {
        // /foo/bar + ./baz => /foo/baz
        $context = dirname($source);
        if ($context !== '/') {
          $context .= '/';
        }
      }
      return $context.substr($path, 2);
    }

    if (substr($path, 0, 3) === '../') {
      $orig_path = $path;

      if ($in_dir) {
        // /foo/bar/ + ../baz => /foo/baz
        $context = dirname($source);
      } else {
        // /foo/bar + ../baz => /baz
        $context = dirname(dirname($source));
      }
      if ($context !== '/') {
        $context .= '/';
      }
      $path = $context.substr($path, 3);

      while (strpos($path, '/../') !== false) {
        $path = preg_replace('_/[^/]+/\.\./_', '/', $path);
      }
      return $path;
    }

    if ($path[0] !== '.') {
      if ($in_dir) {
        return $source.$path;
      } else {
        return dirname($source).'/'.$path;
      }
    }

    return null;
  }
}
