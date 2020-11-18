<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks;

use namespace HH\Lib\{Regex, Str, Vec};
use namespace HHVM\UserDocumentation\ExampleTypechecker;
use type HHVM\UserDocumentation\LocalConfig;

/**
 * @see FilterBase
 * This subclass should be used from non-automated builds.
 *
 * Writes any missing/changed files extracted from code blocks.
 * HHVM/typechecker output files are only written if missing, existing ones are
 * verified in ExamplesTest.
 */
final class ExtractFilter extends FilterBase {

  <<__Override>>
  protected static function processFile(string $path, string $content): void {
    if (\file_exists($path) && \file_get_contents($path) === $content) {
      return;
    }
    if (!\file_exists(\dirname($path))) {
      \mkdir(\dirname($path));
    }
    \file_put_contents($path, $content);
  }

  <<__Override>>
  protected static function processMissingTypecheckerOutput(
    string $hack_file_path,
    bool $needs_example,
  ): void {
    list($stdout, $_stderr) = \HH\Asio\join(
      ExampleTypechecker\typecheck_example_async($hack_file_path),
    );

    $match = null;
    \preg_match_with_matches(
      Str\format(
        '#"(.*?)/%s"#',
        \basename($hack_file_path)
          |> Str\strip_suffix($$, '.'.self::TYPE_ERRORS)
          |> \preg_quote($$),
      ),
      $stdout,
      inout $match,
    );

    self::writeOutput(
      $stdout,
      $match ? $match[1] : null,
      $hack_file_path,
      Files::TYPECHECKER_EXPECT,
      Files::EXAMPLE_TYPECHECKER_OUT,
      Files::TYPECHECKER_EXPECTF,
      Files::TYPECHECKER_EXPECTREGEX,
      $needs_example,
    );
  }

  <<__Override>>
  protected static function processMissingHHVMOutput(
    string $hack_file_path,
    bool $needs_example,
  ): void {
    $config = $hack_file_path.'.'.Files::INI;
    if (!\file_exists($config)) {
      $config = LocalConfig::ROOT.'/api-sources/hhvm/hphp/test/config.ini';
    }

    $command = vec[
      \PHP_BINARY,
      // use the same config as the test runner in ExamplesTest
      '-c',
      $config,
      '-vEval.EnableArgsInBacktraces=false',
      '-dhhvm.hack.lang.disable_xhp_element_mangling=true',
      '-dauto_prepend_file='.
      LocalConfig::ROOT.
      '/src/utils/_private/init_docs_autoloader.php',
      $hack_file_path,
    ]
      |> Vec\map($$, $arg ==> \escapeshellarg($arg))
      |> Str\join($$, ' ');

    $env = vec[
      'GLOG_minloglevel=3', // get rid of mcrouter examples log spew
    ]
      |> Str\join($$, ' ');

    $exit_code = null;
    $output = null;
    \exec($env.' '.$command.' 2>&1', inout $output, inout $exit_code);

    $match = Regex\first_match($hack_file_path, re"#(.*/user-documentation)/#");

    self::writeOutput(
      Str\join($output, "\n"),
      $match is nonnull ? $match[1] : \dirname($hack_file_path),
      $hack_file_path,
      Files::HHVM_EXPECT,
      Files::EXAMPLE_HHVM_OUT,
      Files::HHVM_EXPECTF,
      Files::HHVM_EXPECTREGEX,
      $needs_example,
    );
  }

  /**
   * If the output contains file paths (which depend on the environment and may
   * even be randomly generated in each run), write an .example.out file (paths
   * replaced with /home/example) and an .expectf file (paths replaced with %s).
   * Otherwise, write the output into a regular .expect file.
   */
  private static function writeOutput(
    string $output,
    ?string $path_to_sanitize,
    string $hack_file_path,
    Files $out_file,
    Files $example_file,
    Files $expectf_file,
    Files $expectregex_file,
    bool $needs_example,
  ): void {
    // Ensure newline at the end of the file.
    if ($output !== '' && !Str\ends_with($output, "\n")) {
      $output .= "\n";
    }

    $out_path = $hack_file_path.'.'.$out_file;
    $example_path = $hack_file_path.'.'.$example_file;
    $expectf_path = $hack_file_path.'.'.$expectf_file;
    $expectregex_path = $hack_file_path.'.'.$expectregex_file;

    if (\file_exists($expectf_path) || \file_exists($expectregex_path)) {
      // Only generate example output.
      invariant(
        $needs_example && !\file_exists($example_path),
        'Tried to auto-generate %s but it already exist (or should not exist)!',
        $example_path,
      );
      \file_put_contents(
        $example_path,
        $path_to_sanitize is nonnull
          ? Str\replace($output, $path_to_sanitize, '/home/example')
          : $output,
      );
    } else if (
      $path_to_sanitize is nonnull && Str\contains($output, $path_to_sanitize)
    ) {
      // Note: One of these may have been explicitly specified in the code
      // block, in which case only auto-generate the other one.
      invariant(
        ($needs_example && !\file_exists($example_path)) ||
        !\file_exists($expectf_path),
        'Tried to auto-generate %s and/or %s but both already exist (or '.
        'should not exist)!',
        $example_path,
        $expectf_path,
      );

      if ($needs_example && !\file_exists($example_path)) {
        \file_put_contents(
          $example_path,
          Str\replace($output, $path_to_sanitize, '/home/example'),
        );
      }

      if (!\file_exists($expectf_path)) {
        \file_put_contents(
          $expectf_path,
          Str\replace($output, '%', '%%')
            |> Str\replace($$, $path_to_sanitize, '%s')
            |> Regex\replace($$, re"/string\\([0-9]+\\)/", 'string(%d)'),
        );
      }
    } else {
      invariant(
        !\file_exists($out_path),
        'Tried to auto-generate %s but it already exists!',
        $out_path,
      );
      \file_put_contents($out_path, $output);
    }
  }
}
