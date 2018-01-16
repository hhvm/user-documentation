<?hh // strict

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
      &$output,
      &$exit_code,
    );
    if ($exit_code === 77) {
      // Server already running - 3.10 => 3.11 regression:
      // https://github.com/facebook/hhvm/issues/6646
      exec('hh_client stop 2>/dev/null');
      $this->testTypecheckerPasses();
      return;
    }
    $this->assertSame(0, $exit_code, implode("\n", $output));
  }
}
