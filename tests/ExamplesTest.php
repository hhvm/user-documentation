<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type HHVM\UserDocumentation\{BuildPaths, LocalConfig};
use namespace HH\Lib\{Str, Vec};

/**
 * @large
 */
class ExamplesTest extends \PHPUnit_Framework_TestCase {
  const string TEST_RUNNER = BuildPaths::HHVM_TREE.'/hphp/test/run';

  public function testExamplesOutput(): void {
    $exclude_suffixes = vec[
      '.inc.php',
      '.php.type-errors',
      '.noexec.php',
    ];
    $exclude_regexp = $exclude_suffixes
      |> Vec\map($$, $suffix ==> preg_quote($suffix, '/'))
      |> Str\join($$, '|')
      |> '/('.$$.')$/';
    $this->runExamples(Vector {
      '--exclude-pattern', $exclude_regexp,
    });
  }

  public function testExamplesTypecheck(): void {
    $hh_server = dirname(PHP_BINARY).'/hh_server';
    if (!file_exists($hh_server)) {
      $this->markTestSkipped("Couldn't find hh_server");
    }

    $this->runExamples(Vector {
      '--typechecker',
      '--exclude', '.inc.php',
    });
  }

  private function getHHVMPath(): string {
    return PHP_BINARY;
  }

  <<__Memoize>>
  private function getHHServerPath(): string {
    $hh_server = dirname(PHP_BINARY).'/hh_server';
    if (!file_exists($hh_server)) {
      $this->markTestSkipped("Couldn't find hh_server");
    }
    return $hh_server;
  }

  private function runExamples(Vector<string> $extra_args): void {
    $command = Vector {
      PHP_BINARY,
      self::TEST_RUNNER,
      '-m', 'interp',
    };
    $command->addAll($extra_args);
    $command[] = LocalConfig::ROOT.'/guides';

    $command_str = implode(' ', $command->map($arg ==> escapeshellarg($arg)));
    $exit_code = null;
    $output = null;

    $env = Vector {
      'HHVM_BIN='.escapeshellarg($this->getHHVMPath()),
      'HH_SERVER_BIN='.escapeshellarg($this->getHHServerPath()),
    };

    $command_str =
      implode('', $env->map($x ==> $x.' ')).$command_str;

    exec($command_str, /*&*/ $output, /*&*/ $exit_code);

    $this->assertSame(0, $exit_code, implode("\n", $output));
  }
}
