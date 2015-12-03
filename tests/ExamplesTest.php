<?hh

namespace HHVM\UserDocumentation\Tests;

use HHVM\UserDocumentation\LocalConfig;

class ExamplesTest extends \PHPUnit_Framework_TestCase {
  const string TEST_RUNNER = LocalConfig::HHVM_TREE.'/hphp/test/run';

  public function testExamplesOutput(): void {
    $this->runExamples(Vector { });
  }

  public function testExamplesTypecheck(): void {
    $hh_server = LocalConfig::HHVM_TREE.'/hphp/hack/bin/hh_server';
    if (!file_exists($hh_server)) {
      $this->markTestSkipped(
        "hphp/test/run --typechecker needs a built hack tree"
      );
    }
    $this->runExamples(Vector { '--typechecker' });
  }

  private function runExamples(Vector<string> $extra_args): void {
    $command = Vector {
      PHP_BINARY,
      self::TEST_RUNNER,
      '--hhvm-binary-path', PHP_BINARY,
      '-m', 'interp',
    };
    $command->addAll($extra_args);
    $command[] = LocalConfig::ROOT.'/guides';

    $command_str = implode(' ', $command->map($arg ==> escapeshellarg($arg)));
    $exit_code = null;
    $output = null;
    exec($command_str, /*&*/ $output, /*&*/ $exit_code);

    $this->assertSame(0, $exit_code, implode("\n", $output));
  }
}
