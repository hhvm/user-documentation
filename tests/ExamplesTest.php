<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use const HHVM_VERSION_ID;
use function Facebook\FBExpect\expect;
use type HHVM\UserDocumentation\{BuildPaths, LocalConfig};
use namespace HH\Lib\{Str, Vec};

/**
 * @large
 */
class ExamplesTest extends \Facebook\HackTest\HackTest {
  const string TEST_RUNNER = BuildPaths::HHVM_TREE.'/hphp/test/run.php';

  public function testExamplesOutput(): void {
    $exclude_suffixes = vec[
      '.inc.php',
      '.inc.hack',
      '.php.type-errors',
      '.hack.type-errors',
      '.noexec.php',
      '.noexec.hack',
    ];
    $exclude_regexp = $exclude_suffixes
      |> Vec\map($$, $suffix ==> \preg_quote($suffix, '/'))
      |> Str\join($$, '|')
      |> '/('.$$.')$/';
    $this->runExamples(Vector {
      '--exclude-pattern',
      $exclude_regexp,
    });
  }

  public function testExamplesTypecheck(): void {
    if (HHVM_VERSION_ID >= 32600 && HHVM_VERSION_ID <= 32602) {
      static::markTestSkipped(
        'This versions of HHVM is unable to run the test runner',
      );
    }
    $hh_server = \dirname(\PHP_BINARY).'/hh_server';
    if (!\file_exists($hh_server)) {
      static::markTestSkipped("Couldn't find hh_server");
    }

    $this->runExamples(Vector {
      '--typechecker',
      '--exclude',
      '.inc.php',
      '--vendor',
      LocalConfig::ROOT.'/api-sources/hsl/src',
    });
  }

  <<__Memoize>>
  private function getHHServerPath(): string {
    $hh_server = \dirname(\PHP_BINARY).'/hh_server';
    if (!\file_exists($hh_server)) {
      static::markTestSkipped("Couldn't find hh_server");
    }
    return $hh_server;
  }

  private function runExamples(Vector<string> $extra_args): void {
    $command = Vector {
      \PHP_BINARY,
      '-d',
      'hhvm.hack.lang.look_for_typechecker=0',
      self::TEST_RUNNER,
      '-m',
      'interp',
      '--vendor',
      LocalConfig::ROOT.'/vendor/',
    };
    $command->addAll($extra_args);
    $command[] = LocalConfig::ROOT.'/guides';

    $command_str = \implode(' ', $command->map($arg ==> \escapeshellarg($arg)));
    $exit_code = null;
    $output = null;

    $env = Vector {
      'HHVM_BIN='.\escapeshellarg(\PHP_BINARY),
      'HH_SERVER_BIN='.\escapeshellarg($this->getHHServerPath()),
    };

    $command_str = \implode('', $env->map($x ==> $x.' ')).$command_str.' 2>&1';

    \exec($command_str, /*&*/ &$output, /*&*/ &$exit_code);

    // Get full output in case of failure
    \stream_set_blocking(\STDOUT, true);
    expect($exit_code)->toBeSame(0, '%s', \implode("\n", $output));
  }
}
