<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type Facebook\HackTest\{DataProvider, TestGroup};
use type HHVM\UserDocumentation\GuidesNavData;
use function Facebook\FBExpect\expect;

class GuidePagesTest extends \Facebook\HackTest\HackTest {
  public static function allGuidePages(): array<(string, string)> {
    $to_visit = \array_values(GuidesNavData::getNavData());
    $out = [];

    while ($node = \array_pop(inout $to_visit)) {
      foreach ($node['children'] as $child) {
        $to_visit[] = $child;
      }
      $out[] = tuple($node['name'], $node['urlPath']);
    }

    return $out;
  }

  /**
   * @large
   */
  <<DataProvider('allGuidePages')>>
  public async function testGuidePage(
    string $name,
    string $path,
  ): Awaitable<void> {
    await $this->testGuidePageQuick($name, $path);
  }

  public function shortListOfGuidePages(): array<(string, string)> {
    return [
      // Root of a guide
      tuple('Getting Started', '/hack/overview/'),
      // First page of a guide
      tuple('Types: Introduction', '/hack/overview/typing'),
      // Last page of a guide
      tuple('Asynchronous Operations: Exceptions', '/hack/async/exceptions'),
      // Spaces
      tuple(
        'Classes: Constructors',
        '/hack/other-features/constructor-parameter-promotion',
      ),
    ];
  }

  <<DataProvider('shortListOfGuidePages'), TestGroup('remote')>>
  public async function testGuidePageQuick(
    string $name,
    string $path,
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync($path);

    // /hack/foo/ => /hack/foo/introduction
    if ($response->getStatusCode() === 301) {
      list($response, $body) = await PageLoader::getPageAsync(
        $response->getHeaderLine('Location'),
      );
    }

    expect($response->getStatusCode())->toBeSame(200);
    expect($body)->toContain($name);
  }

  <<TestGroup('remote')>>
  public async function testExamplesRender(): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync(
      '/hack/asynchronous-operations/examples',
    );
    expect($response->getStatusCode())->toBeSame(200);

    expect($body)->toContain('highlight');
    // Namespace declaration
    expect($body)->toContain(
      'Hack\UserDocumentation\AsyncOps\Examples\Examples',
    );
  }

  <<TestGroup('remote')>>
  public async function testGeneratedGuidesRender(): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync(
      '/hhvm/configuration/INI-settings',
    );
    expect($response->getStatusCode())->toBeSame(200);
    expect($body)->toContain('allow_url_fopen</a></td>');
  }
}
