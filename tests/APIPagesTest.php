<?hh

namespace HHVM\UserDocumentation\Tests;

use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\NavDataNode;
use HHVM\UserDocumentation\APIDefinitionType;

class APIPagesTest extends \PHPUnit_Framework_TestCase {
  public function allAPIPages(): array<(string, NavDataNode)> {
    $to_visit = array_values(APINavData::getNavData());
    $out = [];

    while ($node = array_pop($to_visit)) {
      foreach ($node['children'] as $child) {
        $to_visit[] = $child;
      }
      $node['children'] = []; // make failure output easier to read
      $out[] = tuple($node['urlPath'], $node);
    }
    return $out;
  }

  public function shortListOfAPIPages(): array<(string, NavDataNode)> {
    $wanted = Set {
      '/hack/reference/class/', // index
      '/hack/reference/class/AsyncMysqlClient/', // class
      '/hack/reference/class/AsyncMysqlConnection/queryf/', // method
      '/hack/reference/function/hphp_array_idx/', // function
      '/hack/reference/class/HH.Asio.WrappedResult/', // namespaced
    };
    $all = $this->allAPIPages();
    $out = [];
    foreach ($all as $tuple) {
      list($_, $node) = $tuple;
      if ($wanted->contains($node['urlPath'])) {
        $out[] = tuple($node['urlPath'], $node);
      }
    }
    $this->assertSame(count($wanted), count($out));

    // Not included in the API Nav bar, but test it too :)
    $out[] = tuple(
      '/hack/reference/',
      shape(
        'urlPath' => '/hack/reference/',
        'name' => 'Hack APIs',
        'children' => [],
      ),
    );
    return $out;
  }

  /**
   * @dataProvider allAPIPages
   * @large
   */
  public function testAPIPage(string $_, NavDataNode $node): void {
    $response = \HH\Asio\join(PageLoader::getPage($node['urlPath']));
    $this->assertSame(200, $response->getStatusCode());

    // Top-level pages don't contain their own name in the output - eg 'Classes'
    // is 'Class Reference'
    $blacklist = (new Set(APIDefinitionType::getValues()))
      ->map($x ==> APINavData::getRootNameForType($x));
    if (!$blacklist->contains($node['name'])) {
      $this->assertContains($node['name'], (string) $response->getBody());
    }
  }

  /**
   * @group remote
   * @dataProvider shortListOfAPIPages
   * @small
   */
  public function testAPIPageQuick(string $name, NavDataNode $node): void {
    $this->testAPIPage($name, $node);
  }
}
