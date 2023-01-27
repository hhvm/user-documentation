<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type Facebook\HackTest\{DataProvider, HackTest};
use type HHVM\UserDocumentation\{BuildPaths, LocalConfig};
use type HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\Files;
use namespace HH\Lib\{C, Str, Vec};
use namespace HHVM\UserDocumentation\ExampleTypechecker;

/**
 * @large
 */
class ExamplesTest extends HackTest {
  const string TEST_RUNNER = BuildPaths::HHVM_TREE.'/hphp/test/run.php';

  public function testExamplesOutput(): void {
    $exclude_suffixes = vec[
      '.inc.php',
      '.inc.hack',
      '.noexec.php',
      '.noexec.hack',
    ];
    $exclude_regexp = $exclude_suffixes
      |> Vec\map($$, $suffix ==> \preg_quote($suffix, '/'))
      |> Str\join($$, '|')
      |> '/('.$$.')$/';
    $this->runExamples(Vector {'--exclude-pattern', $exclude_regexp});
  }

  private function getHHServerPath(): string {
    $hh_server = ExampleTypechecker\get_hh_server_path();
    if ($hh_server is nonnull) {
      return $hh_server;
    }
    static::markTestSkipped("Couldn't find hh_server");
  }

  private function runExamples(Vector<string> $extra_args): void {
    $command = Vector {
      \PHP_BINARY,
      '-d',
      'hhvm.hack.lang.look_for_typechecker=0',
      '-d',
      'hhvm.hack_arr_compat_notices=1',
      '-d',
      'hhvm.hack_arr_compat_implcit_varray_append=1',
      self::TEST_RUNNER,
      '-m',
      'interp',
      '--args',
      // disable_xhp_element_mangling=true is default, but test/run.php
      // overrides it to false, so we have to override it back here
      '-d hhvm.hack.lang.disable_xhp_element_mangling=true '.
        '-d auto_prepend_file='.
        LocalConfig::ROOT.'/src/utils/_private/init_docs_autoloader.php',
    };
    $command->addAll($extra_args);
    $command[] = BuildPaths::EXAMPLES_EXTRACT_DIR;

    $command_str = \implode(' ', $command->map($arg ==> \escapeshellarg($arg)));
    $exit_code = null;
    $output = null;

    $env = Vector {
      'HHVM_BIN='.\escapeshellarg(\PHP_BINARY),
      'HH_SERVER_BIN='.\escapeshellarg($this->getHHServerPath()),
      'GLOG_minloglevel=3', // get rid of mcrouter examples log spew
    };

    $command_str = \implode('', $env->map($x ==> $x.' ')).$command_str.' 2>&1';

    \exec($command_str, inout $output, inout $exit_code);

    // Get full output in case of failure
    \stream_set_blocking(\STDOUT, true);
    expect($exit_code)->toBeSame(0, '%s', \implode("\n", $output));
  }
}
