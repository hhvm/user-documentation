<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type HHVM\UserDocumentation\{
  APINavData,
  APIProduct,
  NavDataNode,
};

/**
 * @small
 */
class APINavDataTest extends \PHPUnit_Framework_TestCase {
  public function testNamespacedDefinitionName(): void {
    $classes = APINavData::get(APIProduct::HACK)
      ->getNavData()['Classes']['children'];
    $have_ns_separator = false;
    foreach ($classes as $node) {
      $node = (($x): NavDataNode ==> /* UNSAFE_EXPR */ $x)($node);
      if (\strpos($node['name'], "HH\\") === 0) {
        $have_ns_separator = true;
        break;
      }
    }
    $this->assertTrue($have_ns_separator);
  }

  public function testNamespacedDefinitionURL(): void {
    $classes = APINavData::get(APIProduct::HACK)
      ->getNavData()['Classes']['children'];

    $have_ns_separator = false;
    foreach ($classes as $node) {
      $node = (($x): NavDataNode ==> /* UNSAFE_EXPR */ $x)($node);
      if (\strpos($node['name'], "HH\\") === 0) {
        $have_ns_separator = true;

        $url_pattern = \strtr($node['name'], "\\", '.');
        $this->assertContains($url_pattern, $node['urlPath']);
        break;
      }
    }
    $this->assertTrue($have_ns_separator);
  }
}
