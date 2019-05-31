<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use const HHVM_VERSION_ID;
use type HHVM\UserDocumentation\{BuildPaths, LocalConfig};
use type Facebook\HackTest\DataProvider;
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
      $ret[] = tuple(Str\slice($path, 0, $idx), $path);
    }
    return $ret;
  }

  <<DataProvider('getTypecheckerExamples')>>
  public async function testExamplesTypecheck(
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
    if (\file_exists($in_file.'.hhconfig')) {
      \copy($in_file, $work_dir.'/.hhconfig');
    } else {
      \touch($work_dir.'/.hhconfig');
    }
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
