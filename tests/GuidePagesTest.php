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
  public function testGuidePage(string $name, string $path): void {
    $this->testGuidePageQuick($name, $path);
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
  public function testGuidePageQuick(string $name, string $path): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync($path));

    // /hack/foo/ => /hack/foo/introduction
    if ($response->getStatusCode() === 301) {
      $response = \HH\Asio\join(
        PageLoader::getPageAsync($response->getHeaderLine('Location')),
      );
    }

    expect($response->getStatusCode())->toBeSame(200);
    expect((string) $response->getBody())->toContain($name);
  }

  /**
   * @group remote
   * @small
   */
  public function testExamplesRender(): void {
    $response =
      \HH\Asio\join(PageLoader::getPageAsync('/hack/async/introduction'));
    expect($response->getStatusCode())->toBeSame(200);

    $body = (string) $response->getBody();
    expect($body)->toContain('highlight');
    // Namespace declaration
    expect($body)->toContain('Hack\UserDocumentation\Async\Intro\Examples');
  }

  /**
   * @group remote
   * @small
   */
  public function testGeneratedGuidesRender(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('/hhvm/configuration/INI-settings'),
    );
    expect($response->getStatusCode())->toBeSame(200);

    $body = (string) $response->getBody();
    expect($body)->toContain('allow_url_fopen</a></td>');
  }

  public function testCachedNavDataIsNotJustByName(): void {
    list(
      $hack,
      $hhvm,
    ) = \HH\Asio\join(
      Tuple\from_async(
        PageLoader::getPageAsync('/hack/typechecker/introduction'),
        PageLoader::getPageAsync('/hhvm/configuration/INI-settings'),
      ),
    );
    $hack = (string) $hack->getBody();
    $hhvm = (string) $hhvm->getBody();
    expect($hack)->toContain('/hack/getting-started/getting-started');
    expect($hhvm)->toContain('/hhvm/getting-started/getting-started');
  }
}
