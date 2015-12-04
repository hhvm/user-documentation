<?hh

namespace HHVM\UserDocumentation\Tests;

/**
 * @small
 */
class TypecheckerTest extends \PHPUnit_Framework_TestCase {
  public function testTypecheckerPasses(): void {
    $output = array();
    $exit_code = null;
    exec(
      'hh_server --check '.escapeshellarg(__DIR__.'/../').' 2>&1',
      $output,
      $exit_code,
    );
    $this->assertSame(0, $exit_code, implode("\n", $output));
  }
}
