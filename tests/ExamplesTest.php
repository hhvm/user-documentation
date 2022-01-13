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

  /**
   * Find all examples that have the specified extra file (e.g. all examples
   * with .typechecker.expect).
   */
  public static function getExamplesWith(
    Files $name_part,
  ): vec<(string, string)> {
    $ret = vec[];
    $it = new \RecursiveIteratorIterator(
      new \RecursiveDirectoryIterator(BuildPaths::EXAMPLES_EXTRACT_DIR),
    );
    foreach ($it as $info) {
      if (!$info->isFile()) {
        continue;
      }
      $path = $info->getPathname();
      $idx = Str\search($path, '.'.$name_part);
      if ($idx === null) {
        continue;
      }
      $ret[] = tuple(Str\slice($path, 0, $idx), $path);
    }
    return $ret;
  }

  public static function provideExampleOutFiles(
  ): dict<string, (string, string, Files)> {
    $ret = dict[];
    foreach (
      vec[Files::EXAMPLE_HHVM_OUT, Files::EXAMPLE_TYPECHECKER_OUT] as $type
    ) {
      foreach (self::getExamplesWith($type) as list($hack_file, $out_file)) {
        $ret[$hack_file] = tuple($hack_file, $out_file, $type);
      }
    }
    return $ret;
  }

  <<DataProvider('provideExampleOutFiles')>>
  public function testExampleOutMatchesExpect(
    string $hack_path,
    string $example_out_path,
    Files $type,
  ): void {
    $expectf = $hack_path.'.';
    $expectf .= $type === Files::EXAMPLE_HHVM_OUT
      ? Files::HHVM_EXPECTF
      : Files::TYPECHECKER_EXPECTF;
    $expectregex = $hack_path.'.';
    $expectregex .= $type === Files::EXAMPLE_HHVM_OUT
      ? Files::HHVM_EXPECTREGEX
      : Files::TYPECHECKER_EXPECTREGEX;

    if (\file_exists($expectf)) {
      expect($example_out_path)->toMatchExpectfFile($expectf);
    } else if (\file_exists($expectregex)) {
      expect($example_out_path)->toMatchExpectregexFile($expectregex);
    } else {
      invariant_violation('Example has no .expectf or .expectregex file!');
    }
  }

  public async function testExamplesTypecheck(): Awaitable<void> {
    // Ideally HackTest would support parallelism via xbox or async;
    // statefullness needs to be avoid or managed first though :'(

    $concurrency_limit = 10;
    $todo = new \HH\Lib\Ref(self::getExamplesWith(Files::TYPECHECKER_EXPECT));
    await Vec\map_async(
      Vec\range(1, $concurrency_limit),
      async $_worker_id ==> {
        while (!C\is_empty($todo->value)) {
          list($in, $expect) = C\firstx($todo->value);
          $todo->value = Vec\drop($todo->value, 1);
          invariant(
            Str\contains($expect, '.type-errors') ||
              \file_get_contents($expect) === "No errors!\n",
            "'%s' does not contain '.type-errors' in it's name, but does not ".
            "exactly match \"No errors!\n\"",
            $expect,
          );
          /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
          await $this->runSingleExampleThroughTypecheckerAsync($in, $expect);
        }
      },
    );
  }

  private async function runSingleExampleThroughTypecheckerAsync(
    string $in_file,
    string $expect_file,
  ): Awaitable<void> {
    $this->getHHServerPath(); // marks test skipped instead of failing below

    list($stdout, $stderr) =
      await ExampleTypechecker\typecheck_example_async($in_file);

    $stdout_file = $in_file.'.typechecker.stdout';
    \file_put_contents($stdout_file, $stdout);
    \file_put_contents($in_file.'.typechecker.stderr', $stderr);

    if (Str\ends_with($expect_file, '.expect')) {
      expect($stdout_file)->toMatchExpectFile($expect_file);
    } else if (Str\ends_with($expect_file, '.expectf')) {
      expect($stdout_file)->toMatchExpectfFile($expect_file);
    } else {
      expect(Str\ends_with($expect_file, '.expectregex'))->toBeTrue(
        "%s does not end with .expect, .expectf, or .expectregex",
        $expect_file,
      );
      expect($stdout_file)->toMatchExpectregexFile($expect_file);
    }
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
