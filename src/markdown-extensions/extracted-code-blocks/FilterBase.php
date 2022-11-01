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

use namespace HH\Lib\{C, Dict, Keyset, Regex, Str, Vec};
use namespace Facebook\{Markdown, Markdown\Blocks};
use namespace HHVM\UserDocumentation\MarkdownExt;
use type HHVM\UserDocumentation\BuildPaths;

/**
 * Processes code blocks starting with one of:
 *   ```hack filename.ext[.type-errors]
 *   ```filename.ext[.type-errors]
 * where ext is one of self::ALLOWED_EXTENSIONS.
 *
 * Depending on the subclass, either writes all related files (manual builds),
 * or complains if any file is missing or outdated (CI/automated builds).
 *
 * Optional extra files can be specified using one of:
 *    ```suffix
 *    ```.suffix
 *    ```filename.ext.suffix
 * inside the code block.
 *
 * If not explicitly specified, these files are generated automatically:
 * - filename.ext.typechecker.expectf + filename.ext.example.typechecker.out
 *     by running the typechecker if the main file is *.type-errors
 *     (file paths replaced with %s)
 * - filename.ext.typechecker.expect
 *     with "No errors!" otherwise
 * - filename.ext.hhvm.expect
 *     by running HHVM, only if the main file is not *.type-errors
 * - filename.ext.hhvm.expectf + filename.ext.example.hhvm.out
 *     instead of .expect if the output contains file paths (e.g. in errors)
 * - filename.ext.hhconfig (empty)
 */
abstract class FilterBase extends Markdown\RenderFilter {

  const TYPE_ERRORS = 'type-errors';

  const keyset<string> ALLOWED_EXTENSIONS = keyset[
    'hack',
    'hackpartial',
    'php',
    'hack.'.self::TYPE_ERRORS,
    'hackpartial.'.self::TYPE_ERRORS,
    'php.'.self::TYPE_ERRORS,
  ];

  const dict<string, Files> FILE_ALIASES = dict[
    'expect' => Files::HHVM_EXPECT,
    'expectf' => Files::HHVM_EXPECTF,
    'expectregex' => Files::HHVM_EXPECTREGEX,
    'example.out' => Files::EXAMPLE_HHVM_OUT,
  ];

  const keyset<string> COMMON_HSL_NAMESPACES = keyset[
    'C',
    'Dict',
    'Keyset',
    'Math',
    'Regex',
    'Str',
    'Vec',
  ];

  const dict<string, string> PATHS = dict[
    BuildPaths::APIDOCS_MARKDOWN => BuildPaths::API_EXAMPLES_EXTRACT_DIR,
    BuildPaths::GUIDES_MARKDOWN => BuildPaths::GUIDES_EXAMPLES_EXTRACT_DIR,
  ];

  private static keyset<string> $validFiles = keyset[];

  final public static function getAllValidFiles(): keyset<string> {
    return self::$validFiles;
  }

  <<__Override>>
  public function filter(
    Markdown\RenderContext $context,
    Markdown\ASTNode $node,
  ): vec<Markdown\ASTNode> {
    if (!$node is Blocks\CodeBlock || $node is MarkdownExt\PrettyCodeBlock) {
      return vec[$node];
    }

    $info_string = Str\trim($node->getInfoString() ?? '');
    if ($info_string === '') {
      return vec[$node];
    }

    $parts = Regex\split($info_string, re"/\\s+/");
    if (Str\compare_ci($parts[0], 'hack') === 0) {
      $parts = Vec\drop($parts, 1);
    }

    if (C\is_empty($parts)) {
      return vec[$node];
    }

    $hack_filename = $parts[0];
    if (
      !C\any(
        self::ALLOWED_EXTENSIONS,
        $ext ==> Str\ends_with($hack_filename, '.'.$ext),
      )
    ) {
      // Not a Hack code block, or a block without a filename specified -- don't
      // extract.
      return vec[$node];
    }

    $flags = Keyset\drop($parts, 1);
    foreach ($flags as $flag) {
      if (!$flag is Flags) {
        invariant_violation(
          '"%s" is not a valid code block option (valid options: %s)',
          $flag,
          Str\join(Flags::getValues(), ', '),
        );
      }
    }

    // To preserve old behavior, we also allow flags inside the filename.
    foreach (Flags::getValues() as $flag) {
      if (Str\contains($hack_filename, '.'.$flag.'.')) {
        $flags[] = $flag;
      }
    }

    // Another historical edge case: .inc files are never executed.
    if (Str\contains($hack_filename, '.inc.')) {
      $flags[] = Flags::NO_EXEC;
    }

    $file_lines = dict[$hack_filename => vec[]];
    $current_file = $hack_filename;
    foreach (Str\split($node->getCode(), "\n") as $line) {
      if (Str\starts_with($line, '```')) {
        $ext = Str\strip_prefix($line, '```')
          |> Str\trim($$)
          |> Str\strip_prefix($$, $hack_filename)
          |> Str\strip_prefix($$, '.')
          |> idx(self::FILE_ALIASES, $$, $$);
        invariant(
          $ext is Files,
          '``` must be followed by a valid file extension, got "%s" '.
          '(valid extensions: %s)',
          $ext,
          Str\join(Files::getValues(), ', '),
        );
        $current_file = $hack_filename.'.'.$ext;
        invariant(
          !C\contains_key($file_lines, $current_file),
          'Code block contains multiple "%s" sections!',
          $ext,
        );
        $file_lines[$current_file] = vec[];
        continue;
      }
      $file_lines[$current_file][] = $line;
    }

    $md = $context as MarkdownExt\RenderContext->getFilePath();
    invariant($md is nonnull, 'RenderContext is missing file path');
    invariant(Str\ends_with($md, '.md'), 'Expected a .md file, got "%s"', $md);
    $examples_dir = Str\strip_suffix($md, '.md')
      |> Str\replace_every($$, self::PATHS);
    $hack_file_path = $examples_dir.'/'.$hack_filename;
    $expected_type_errors =
      Str\ends_with($hack_filename, '.'.self::TYPE_ERRORS);

    $files = Dict\map(
      $file_lines,
      $lines ==> Str\join($lines, "\n") |> Str\trim($$)."\n",
    );

    $original_code = $files[$hack_filename];
    $files[$hack_filename] =
      self::addBoilerplate($hack_file_path, $files[$hack_filename]);

    $skipif = $hack_filename.'.'.Files::SKIPIF;
    if (C\contains_key($files, $skipif)) {
      $files[$skipif] = self::addBoilerplate($hack_file_path, $files[$skipif]);
    }

    // Write or verify files.
    $inputs_changed = false;
    foreach ($files as $name => $content) {
      $path = $examples_dir.'/'.$name;
      self::$validFiles[] = $path;
      $inputs_changed =
        static::processFile($path, $content) || $inputs_changed;
    }

    // If any inputs changed, delete all other files (mainly output/expect
    // files, but also other files like hhconfig/skipif that may have been
    // previously included in the example block but no longer are). This ensures
    // that the correct subset of output/expect files is regenerated below.
    if ($inputs_changed) {
      foreach (Files::getValues() as $suffix) {
        $name = $hack_filename.'.'.$suffix;
        if (C\contains_key($files, $name)) {
          continue;
        }
        $path = $examples_dir.'/'.$name;
        if (\file_exists($path)) {
          \unlink($path);
          invariant(!\file_exists($path), 'Failed to delete %s', $path);
        }
      }
    }

    // Auto-generate or verify *existence* of output files if missing.
    $output_title = 'Output';
    $output = '';

    // Generate/verify typechecker output, if type errors are expected.
    if ($expected_type_errors) {
      $show_output = !C\contains_key($flags, Flags::NO_AUTO_OUTPUT);
      if (
        !self::hasValidOutputFileSet(
          $hack_file_path,
          Files::TYPECHECKER_EXPECT,
          Files::EXAMPLE_TYPECHECKER_OUT,
          Files::TYPECHECKER_EXPECTF,
          Files::TYPECHECKER_EXPECTREGEX,
          // don't generate .example.out if output is not shown in the guide
          $show_output,
        )
      ) {
        static::processMissingTypecheckerOutput($hack_file_path, $show_output);
      }
      if ($show_output) {
        $output_title = 'Typechecker output';
        $output = \file_exists($hack_file_path.'.'.Files::TYPECHECKER_EXPECT)
          ? \file_get_contents($hack_file_path.'.'.Files::TYPECHECKER_EXPECT)
          : \file_get_contents(
              $hack_file_path.'.'.Files::EXAMPLE_TYPECHECKER_OUT,
            );
      }
    }

    // Generate/verify HHVM output.
    if (!C\contains_key($flags, Flags::NO_EXEC)) {
      $show_output = !$expected_type_errors &&
        !C\contains_key($flags, Flags::NO_AUTO_OUTPUT);
      if (
        !self::hasValidOutputFileSet(
          $hack_file_path,
          Files::HHVM_EXPECT,
          Files::EXAMPLE_HHVM_OUT,
          Files::HHVM_EXPECTF,
          Files::HHVM_EXPECTREGEX,
          // don't generate .example.out if output is not shown in the guide
          $show_output,
        )
      ) {
        static::processMissingHHVMOutput($hack_file_path, $show_output);
      }
      if ($show_output) {
        $output = \file_exists($hack_file_path.'.'.Files::HHVM_EXPECT)
          ? \file_get_contents($hack_file_path.'.'.Files::HHVM_EXPECT)
          : \file_get_contents($hack_file_path.'.'.Files::EXAMPLE_HHVM_OUT);
      }
    }
    $output = Str\trim($output);

    $ret = vec[
      new Blocks\FencedCodeBlock('Hack', Str\trim($original_code)),
    ];
    if ($output !== '' && !C\contains_key($flags, Flags::NO_AUTO_OUTPUT)) {
      $ret[] = new Blocks\HTMLBlock('<em>'.$output_title.'</em>');
      $ret[] = new Blocks\FencedCodeBlock(null, $output);
    }
    return $ret;
  }

  /**
   * If you're reading this because this method caused an invalid Hack file to
   * be extracted from a code block in your .md file, please try to either fix
   * this method, or modify your example to work around the issue, e.g. by
   * adding explicit declarations to prevent them from being auto-generated.
   */
  private static function addBoilerplate(
    string $path,
    string $extracted_code,
  ): string {
    // Strip #! and <?hh lines so that we don't insert any code before them
    // below. The stripped lines are added back at the end.
    $m = Regex\first_match($extracted_code, re"/^(#!.*\n|)(<\\?hh.*\n|)\\s*/");
    $headers = $m is nonnull ? $m[0] : '';
    $code = Str\strip_prefix($extracted_code, $headers);

    // If we can't find any top-level declarations, assume the code block
    // contains top-level code that needs to be wrapped in an <<__EntryPoint>>
    // function. This would ideally be done using HHAST, but that would be too
    // expensive.
    if (!Regex\matches(
      $code,
      re"/^(namespace|use|const|(async |)function|[a-z ]*class|interface|trait|enum) /m",
    )) {
      $code = Str\trim_right($code)
        |> Str\split($$, "\n")
        |> Vec\map($$, $line ==> Str\trim_right('  '.$line))
        |> Str\join($$, "\n");
      $code = "<<__EntryPoint>>\n".
        "async function _main(): Awaitable<void> {\n$code\n}\n";
    }

    // Insert \init_docs_autoloader() call at the beginning of the
    // <<__EntryPoint>> function (if there is one).
    if (
      !Str\ends_with($path, '.'.self::TYPE_ERRORS) &&
      Str\contains($code, '<<__EntryPoint>>') &&
      !Str\contains($code, 'init_docs_autoloader()')
    ) {
      $entrypoint_opening_brace = Str\search(
        $code,
        '{',
        Str\search($code, '<<__EntryPoint>>') as nonnull
      );
      invariant(
        $entrypoint_opening_brace is nonnull,
        'Failed to locate <<__EntryPoint>> opening brace.',
      );
      $code = Str\slice($code, 0, $entrypoint_opening_brace + 1).
        "\n  \\init_docs_autoloader();\n".
        Str\slice($code, $entrypoint_opening_brace + 1);
    }

    // Insert `use` clauses for common HSL namespaces. There might be some false
    // positives here, but that's fine.
    $uses = vec[];
    foreach (self::COMMON_HSL_NAMESPACES as $ns) {
      if (
        Str\contains($code, $ns.'\\') &&
        !\preg_match('/^use namespace HH\\\\Lib\\\\.*'.$ns.'/m', $code)
      ) {
        $uses[] = $ns;
      }
    }
    if (!C\is_empty($uses)) {
      $uses_str = Str\join($uses, ', ');
      if (C\count($uses) > 1) {
        $uses_str = '{'.$uses_str.'}';
      }
      $code = 'use namespace HH\\Lib\\'.$uses_str.";\n\n$code";
    }

    // Generate a unique namespace name (unless one is already specified),
    // e.g. HHVM\UserDocumentation\Guides\Hack\GettingStarted\MyFirstProgram.
    if (
      !Str\starts_with($code, 'namespace ') &&
      !Str\contains($code, "\nnamespace ")
    ) {
      // Cut off anything after the first period. This makes it possible to
      // force multiple examples to use the same namespace, e.g. example.hack
      // and example.inc.hack.
      $suffix = Str\split(\basename($path), '.', 2)[1];
      $ns = Str\strip_suffix($path, '.'.$suffix)
        |> Str\strip_prefix($$, BuildPaths::EXAMPLES_EXTRACT_DIR.'/')
        |> Str\split($$, '/')
        |> Vec\map(
          $$,
          $part ==> Str\trim_left($part, '0123456789-_')
            |> Str\capitalize($$)
            |> Regex\replace_with( // convert to CamelCase
              $$,
              re"/[^a-zA-Z0-9]+([a-zA-Z0-9])/",
              $match ==> Str\uppercase($match[1]),
            ),
        )
        |> Str\join($$, '\\');
      $code = 'namespace HHVM\\UserDocumentation\\'.$ns.";\n\n$code";
    }

    if ($code !== $extracted_code) {
      $code =
        "// WARNING: Contains some auto-generated boilerplate code, see:\n".
        '// '.__METHOD__."\n\n".
        $code;
    }

    if (Str\contains($path, '.php') && !Str\contains($headers, '<?hh')) {
      $code = "<?hh\n\n".$code;
    }

    return $headers.$code;
  }

  /**
   * Valid combination: return true
   * Extra files: always throw from here
   * Missing files: return false (subclass will either create them, or throw)
   */
  private static function hasValidOutputFileSet(
    string $hack_file_path,
    Files $expect,
    Files $example,
    Files $expectf,
    Files $expectregex,
    bool $needs_example,
  ): bool {
    // Not all of these are allowed to exist at the same time, but at this point
    // we may not know which exact combination will be generated, so for the
    // purposes of self::$validFiles we have to consider them all valid. There
    // are additional checks below for any invalid combinations.
    self::$validFiles[] = $hack_file_path.'.'.$expect;
    self::$validFiles[] = $hack_file_path.'.'.$expectf;
    self::$validFiles[] = $hack_file_path.'.'.$expectregex;
    self::$validFiles[] = $hack_file_path.'.'.$example;

    $has_expect = \file_exists($hack_file_path.'.'.$expect);
    $has_expectf = \file_exists($hack_file_path.'.'.$expectf);
    $has_expectregex = \file_exists($hack_file_path.'.'.$expectregex);
    $has_example = \file_exists($hack_file_path.'.'.$example);

    if ($has_expect) {
      // Simple case, .expect must be the only file.
      invariant(
        !$has_expectf && !$has_expectregex && !$has_example,
        '%s has a .%s file, but also other conflicting expect/output files!',
        $hack_file_path,
        $expect,
      );
      return true;
    }

    // Exactly one of these must be present, but never both.
    invariant(
      !$has_expectf || !$has_expectregex,
      '%s has both a .%s and a conflicting .%s file!',
      $hack_file_path,
      $expectf,
      $expectregex,
    );

    // Example file should exist if and only if $needs_example is set.
    invariant(
      $needs_example || !$has_example,
      '%s has a redundant .%s file!',
      $hack_file_path,
      $example,
    );

    return (!$needs_example || $has_example) &&
      ($has_expectf || $has_expectregex);
  }

  /**
   * Return true if the file changed.
   */
  abstract protected static function processFile(
    string $name,
    string $content,
  ): bool;

  abstract protected static function processMissingTypecheckerOutput(
    string $hack_filename,
    bool $needs_example,
  ): void;

  abstract protected static function processMissingHHVMOutput(
    string $hack_filename,
    bool $needs_example,
  ): void;
}
