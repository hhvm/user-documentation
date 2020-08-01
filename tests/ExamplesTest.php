<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use const HHVM_VERSION_ID;
use type HHVM\UserDocumentation\{BuildPaths, LocalConfig};
use namespace HH\Lib\{C, Regex, Str, Vec};
use function HHVM\UserDocumentation\_Private\execute_async;

/**
 * @large
 */
class ExamplesTest extends \Facebook\HackTest\HackTest {
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
    $this->runExamples(Vector {
      '--exclude-pattern',
      $exclude_regexp,
    });
  }

  public function getTypecheckerExamples(): vec<(string, string)> {
    $ret = vec[];
    $it = new \RecursiveIteratorIterator(
      new \RecursiveDirectoryIterator(LocalConfig::ROOT.'/guides/'),
    );
    foreach ($it as $info) {
      if (!$info->isFile()) {
        continue;
      }
      $path = $info->getPathname();
      $idx = Str\search($path, '.typechecker.expect');
      if ($idx === null) {
        continue;
      }
      if (!Str\contains($path, '.type-errors')) {
        invariant(
          \file_get_contents($path) === "No errors!\n",
          "'%s' does not contain '.type-errors' in it's name, but does not ".
          "exactly match \"No errors!\n\"",
          $path,
        );
        // Trust the project-wide typechecker to pick up any problems in files
        // with valid extensions
        continue;
      }
      $ret[] = tuple(Str\slice($path, 0, $idx), $path);
    }
    return $ret;
  }

  public async function testExamplesTypecheck(): Awaitable<void> {
    // Ideally HackTest would support parallelism via xbox or async;
    // statefullness needs to be avoid or managed first though :'(

    $concurrency_limit = 10;
    $todo = new \HH\Lib\Ref($this->getTypecheckerExamples());
    await Vec\map_async(
      Vec\range(1, $concurrency_limit),
      async $_worker_id ==> {
        while (!C\is_empty($todo->value)) {
          list($in, $expect) = C\firstx($todo->value);
          $todo->value = Vec\drop($todo->value, 1);
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
    $source_dir = \dirname($in_file);
    await using $tmp_dir = new TemporaryDirectory();
    await using $hh_tmp_dir = new TemporaryDirectory();
    $work_dir = $tmp_dir->getPath();

    \copy(
      $in_file,
      $work_dir.'/'.Str\strip_suffix(\basename($in_file), '.type-errors'),
    );

    $hhconfig = \file_exists($in_file.'.hhconfig')
      ? \file_get_contents($in_file.'.hhconfig')."\n"
      : '';
    if (
      !Str\contains($hhconfig, 'allowed_decl_fixme_codes') &&
      !Str\contains($hhconfig, 'allowed_fixme_codes_strict')
    ) {
      $hhconfig .= self::getHHConfigWhitelists();
    }
    \file_put_contents($work_dir.'/.hhconfig', $hhconfig);

    foreach (\glob($source_dir.'/*.inc.php') as $include_file) {
      \copy($include_file, $work_dir.'/'.\basename($include_file));
    }

    list($_exit_code, $stdout, $stderr) = await execute_async(
      shape('environment' => dict['HH_TMPDIR' => $hh_tmp_dir->getPath()]),
      $this->getHHServerPath(),
      '--check',
      '--max-procs=1',
      '--config',
      'extra_paths='.LocalConfig::ROOT.'/vendor/',
      $work_dir,
    );
    \file_put_contents($in_file.'.typechecker.stdout', $stdout);
    \file_put_contents($in_file.'.typechecker.stderr', $stderr);

    if (Str\ends_with($expect_file, '.expect')) {
      expect($stdout)->toMatchExpectFile($expect_file);
    } else if (Str\ends_with($expect_file, '.expectf')) {
      expect($stdout)->toMatchExpectfFile($expect_file);
    } else {
      expect(Str\ends_with($stdout, '.expectregex'))->toBeTrue(
        "%s does not end with .expect, .expectf, or .expectregex",
        $expect_file,
      );
      expect($stdout)->toMatchExpectregexFile($expect_file);
    }
  }

  <<__Memoize>>
  private static function getHHConfigWhitelists(): string {
    $hhconfig = \file_get_contents(LocalConfig::ROOT.'/.hhconfig');
    $ret = '';
    foreach (
      vec[
        re"/^allowed_decl_fixme_codes=.*\$/m",
        re"/^allowed_fixme_codes_strict=.*\$/m",
      ] as $regex
    ) {
      $m = Regex\first_match($hhconfig, $regex);
      if ($m is nonnull) {
        $ret .= $m[0]."\n";
      }
    }
    return $ret;
  }

  <<__Memoize>>
  private function getHHServerPath(): string {
    $hh_server = \dirname(\PHP_BINARY).'/hh_server';
    if (\file_exists($hh_server)) {
      return $hh_server;
    }

    foreach (Str\split(\getenv('PATH'), ':') as $dir) {
      $hh_server = $dir.'/hh_server';
      if (\file_exists($hh_server)) {
        return $hh_server;
      }
    }
    static::markTestSkipped("Couldn't find hh_server");
    invariant_violation('unreachable');
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
      '-d auto_prepend_file='.
        LocalConfig::ROOT.'/src/utils/_private/__init_autoload.php',
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

    \exec($command_str, inout $output, inout $exit_code);

    // Get full output in case of failure
    \stream_set_blocking(\STDOUT, true);
    expect($exit_code)->toBeSame(0, '%s', \implode("\n", $output));
  }
}
