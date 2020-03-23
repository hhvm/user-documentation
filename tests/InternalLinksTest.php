<?hh // partial

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;

/**
 * @large
 */
final class InternalLinksTest extends \Facebook\HackTest\HackTest {
  <<DataProvider('internalLinksList')>>
  public async function testInternalLink(
    string $target,
    vec<string> $sources,
  ): Awaitable<void> {
    list($response, $_body) = await PageLoader::getPageAsync($target);
    if ($response->getStatusCode() === 301) {
      $target = $response->getHeaderLine('Location');
      list($response, $_body) = await PageLoader::getPageAsync($target);
    }

    $sources = new Set($sources);

    expect($response->getStatusCode())->toBeSame(
      200,
      \sprintf(
        ">>> %d: %s\n>>> Linked from:\n%s",
        $response->getStatusCode(),
        $target,
        \implode("\n", $sources->map($x ==> '>>>  - '.$x)),
      ),
    );
  }

  public async function testDoesNotBreakExternalMarkdownLinks(
  ): Awaitable<void> {
    list($_response, $body) = await PageLoader::getPageAsync(
      '/hack/getting-started/tools',
    );
    expect($body)
      ->toContainSubstring('href="https://github.com/hhvm/hack-mode"');
  }

  public async function testCanGetLinksList(): Awaitable<void> {
    $_ = $this->internalLinksList();
  }


  <<__Memoize>>
  public function internalLinksList(): vec<(string, vec<string>)> {
    PageLoader::assertLocal();
    $loaders = Map {};

    $api_pages = APIPagesTest::allAPIPages();
    foreach ($api_pages as $call) {
      list($_, $node) = $call;
      $url = $node['urlPath'];
      $loaders[$url] = $this->getInternalLinksOnPageAsync($url);
    }

    $guide_pages = GuidePagesTest::allGuidePages();
    foreach ($guide_pages as $call) {
      list($_, $url) = $call;
      $loaders[$url] = $this->getInternalLinksOnPageAsync($url);
    }

    $urls = \HH\Asio\join(\HH\Asio\m($loaders));

    $targets_to_sources = Map {};
    foreach ($urls as $source => $targets) {
      foreach ($targets as $target) {
        if (!$targets_to_sources->containsKey($target)) {
          $targets_to_sources[$target] = vec[];
        }
        $targets_to_sources[$target][] = $source;
      }
    }

    $ret = vec[];
    foreach ($targets_to_sources as $target => $sources) {
      $ret[] = tuple($target, $sources);
    }

    return $ret;
  }

  <<__Memoize>>
  private async function getInternalLinksOnPageAsync(
    string $page,
  ): Awaitable<Vector<string>> {
    PageLoader::assertLocal();

    list($response, $body) = await PageLoader::getPageAsync($page);

    if ($response->getStatusCode() === 301) {
      return await $this->getInternalLinksOnPageAsync(
        $response->getHeaderLine('Location'),
      );
    }

    expect($response->getStatusCode())->toBeSame(200, $page);

    $dom = new \DOMDocument();
    \libxml_use_internal_errors(true); // No support for HTML5 tags
    $dom->loadHTML($body);
    \libxml_clear_errors();
    $xpath = new \DOMXPath($dom);
    $hrefs = $xpath->query('//a/@href');

    $links = Vector {};
    foreach ($hrefs as $node) {
      $url = $node->value;

      $host = \parse_url($url, \PHP_URL_HOST);
      if ($host !== null) {
        continue;
      }

      $path = $this->normalizePath($page, \parse_url($url, \PHP_URL_PATH));
      if ($path === null) {
        continue;
      }

      $links[] = $path;
    }
    return $links;
  }

  public function pathNormalizationTestCases(
  ): vec<(string, string, string)> {
    return vec[
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
   *
   * Testing the test...
   */
  <<DataProvider('pathNormalizationTestCases')>>
  public async function testPathNormalization(
    string $context,
    string $in,
    ?string $expected,
  ): Awaitable<void> {
    $out = $this->normalizePath($context, $in);
    expect($out)->toBeSame($expected);
  }

  private function normalizePath(string $source, ?string $path): ?string {
    if ($path === null) {
      return $path;
    }

    if ($path[0] === '/') {
      return $path;
    }

    $in_dir = \substr($source, -1) === '/';

    if (\substr($path, 0, 2) === './') {
      if ($in_dir) {
        // /foo/bar/ + ./baz => /foo/bar/baz
        $context = $source;
      } else {
        // /foo/bar + ./baz => /foo/baz
        $context = \dirname($source);
        if ($context !== '/') {
          $context .= '/';
        }
      }
      return $context.\substr($path, 2);
    }

    if (\substr($path, 0, 3) === '../') {
      if ($in_dir) {
        // /foo/bar/ + ../baz => /foo/baz
        $context = \dirname($source);
      } else {
        // /foo/bar + ../baz => /baz
        $context = \dirname(\dirname($source));
      }
      if ($context !== '/') {
        $context .= '/';
      }
      $path = $context.\substr($path, 3);

      while (\strpos($path, '/../') !== false) {
        $path = \preg_replace('_/[^/]+/\.\./_', '/', $path);
      }
      return $path;
    }

    if ($path[0] !== '.') {
      if ($in_dir) {
        return $source.$path;
      } else {
        return \dirname($source).'/'.$path;
      }
    }

    return null;
  }
}
