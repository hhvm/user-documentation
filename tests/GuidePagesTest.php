<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type HHVM\UserDocumentation\GuidesNavData;
use namespace HH\Lib\Tuple;
use function Facebook\FBExpect\expect;

class GuidePagesTest extends \Facebook\HackTest\HackTest {
  public static function allGuidePages(): array<(string, string)> {
    $to_visit = \array_values(GuidesNavData::getNavData());
    $out = [];

    while ($node = \array_pop(&$to_visit)) {
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
      tuple('Overview: Typing', '/hack/overview/'),
      // First page of a guide
      tuple('Overview: Typing', '/hack/overview/typing'),
      // Last page of a guide
      tuple('Async: Exceptions', '/hack/async/exceptions'),
      // Spaces
      tuple(
        'Other Features: Constructor Parameter Promotion',
        '/hack/other-features/constructor-parameter-promotion',
      ),
    ];
  }

  /**
   * @group remote
   * @small
   */
  <<DataProvider('shortListOfGuidePages')>>
  public async function testGuidePageQuick(
    string $name,
    string $path,
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync($path);

    // /hack/foo/ => /hack/foo/introduction
    if ($response->getStatusCode() === 301) {
      list($response, $body) =
        await PageLoader::getPageAsync($response->getHeaderLine('Location'));
    }

    expect($response->getStatusCode())->toBeSame(200);
    expect($body)->toContain($name);
  }

  /**
   * @group remote
   * @small
   */
  public async function testExamplesRender(): Awaitable<void> {
    list($response, $body) =
      await PageLoader::getPageAsync('/hack/async/introduction');
    expect($response->getStatusCode())->toBeSame(200);

    expect($body)->toContain('highlight');
    // Namespace declaration
    expect($body)->toContain('Hack\UserDocumentation\Async\Intro\Examples');
  }

  /**
   * @group remote
   * @small
   */
  public async function testGeneratedGuidesRender(): Awaitable<void> {
    list($response, $body) =
      await PageLoader::getPageAsync('/hhvm/configuration/INI-settings');
    expect($response->getStatusCode())->toBeSame(200);
    expect($body)->toContain('allow_url_fopen</a></td>');
  }

  public async function testCachedNavDataIsNotJustByName(): Awaitable<void> {
    list(list($_, $hack), list($_, $hhvm)) = await Tuple\from_async(
      PageLoader::getPageAsync('/hack/typechecker/introduction'),
      PageLoader::getPageAsync('/hhvm/configuration/INI-settings'),
    );
    expect($hack)->toContain('/hack/getting-started/getting-started');
    expect($hhvm)->toContain('/hhvm/getting-started/getting-started');
  }
}
