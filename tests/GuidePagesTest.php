<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type HHVM\UserDocumentation\{
  GuidesNavData,
  NavDataNode,
};
use namespace HH\Lib\Tuple;
use function Facebook\FBExpect\expect;

class GuidePagesTest extends \PHPUnit_Framework_TestCase {
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
   * @dataProvider allGuidePages
   * @large
   */
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
   * @dataProvider shortListOfGuidePages
   * @small
   */
  public function testGuidePageQuick(string $name, string $path): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync($path));

    // /hack/foo/ => /hack/foo/introduction
    if ($response->getStatusCode() === 301) {
      $response = \HH\Asio\join(
        PageLoader::getPageAsync($response->getHeaderLine('Location'))
      );
    }

    $this->assertSame(200, $response->getStatusCode());
    $this->assertContains($name, (string) $response->getBody());
  }

  /**
   * @group remote
   * @small
   */
  public function testExamplesRender(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/hack/async/introduction'));
    $this->assertSame(200, $response->getStatusCode());

    $body = (string) $response->getBody();
    $this->assertContains('highlight', $body);
    // Namespace declaration
    $this->assertContains('Hack\UserDocumentation\Async\Intro\Examples', $body);
  }

  /**
   * @group remote
   * @small
   */
  public function testGeneratedGuidesRender(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('/hhvm/configuration/INI-settings')
    );
    $this->assertSame(200, $response->getStatusCode());

    $body = (string) $response->getBody();
    $this->assertContains('allow_url_fopen</a></td>', $body);
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
