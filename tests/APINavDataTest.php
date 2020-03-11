<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;

use type HHVM\UserDocumentation\{APINavData, APIProduct, NavDataNode};

/**
 * @small
 */
class APINavDataTest extends \Facebook\HackTest\HackTest {
  public function testNamespacedDefinitionName(): void {
    $classes = APINavData::get(APIProduct::HACK)
      ->getNavData()['Classes']['children'];
    $have_ns_separator = false;
    foreach ($classes as $node) {
      /* HH_FIXME[4110] need reified/enforceable */
      $node = (($x): NavDataNode ==> $x)($node);
      if (\strpos($node['name'], "HH\\") === 0) {
        $have_ns_separator = true;
        break;
      }
    }
    expect($have_ns_separator)->toBeTrue();
  }

  public function testNamespacedDefinitionURL(): void {
    $classes = APINavData::get(APIProduct::HACK)
      ->getNavData()['Classes']['children'];

    $have_ns_separator = false;
    foreach ($classes as $node) {
      /* HH_FIXME[4110] need reified/enforceable */
      $node = (($x): NavDataNode ==> $x)($node);
      if (\strpos($node['name'], "HH\\") === 0) {
        $have_ns_separator = true;

        $url_pattern = \strtr($node['name'], "\\", '.');
        expect($node['urlPath'])->toContainSubstring($url_pattern);
        break;
      }
    }
    expect($have_ns_separator)->toBeTrue();
  }
}
