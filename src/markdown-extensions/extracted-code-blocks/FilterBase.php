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
    $examples_dir = Str\strip_suffix($md, '.md').'-examples';
    $hack_file_path = $examples_dir.'/'.$hack_filename;
    $expected_type_errors =
      Str\ends_with($hack_filename, '.'.self::TYPE_ERRORS);

    $files = Dict\map(
      $file_lines,
      $lines ==> Str\join($lines, "\n") |> Str\trim($$)."\n",
    );

    // Add some default files if they weren't explicitly overridden.
    $files[$hack_filename.'.'.Files::HHCONFIG] ??= '';
    if (!$expected_type_errors) {
      $files[$hack_filename.'.'.Files::TYPECHECKER_EXPECT] = "No errors!\n";
    }

    // Write or verify files.
    foreach ($files as $name => $content) {
      static::processFile($examples_dir.'/'.$name, $content);
    }

    // Auto-generate or verify *existence* of output files if missing.
    if ($expected_type_errors) {
      if (
        !self::hasValidOutputFileSet(
          $hack_file_path,
          Files::TYPECHECKER_EXPECT,
          Files::EXAMPLE_TYPECHECKER_OUT,
          Files::TYPECHECKER_EXPECTF,
          Files::TYPECHECKER_EXPECTREGEX,
        )
      ) {
        static::processMissingTypecheckerOutput($hack_file_path);
      }
      $output_title = 'Typechecker output';
      $output = \file_exists($hack_file_path.'.'.Files::TYPECHECKER_EXPECT)
        ? \file_get_contents($hack_file_path.'.'.Files::TYPECHECKER_EXPECT)
        : \file_get_contents(
            $hack_file_path.'.'.Files::EXAMPLE_TYPECHECKER_OUT,
          );
    } else {
      if (
        !self::hasValidOutputFileSet(
          $hack_file_path,
          Files::HHVM_EXPECT,
          Files::EXAMPLE_HHVM_OUT,
          Files::HHVM_EXPECTF,
          Files::HHVM_EXPECTREGEX,
        )
      ) {
        static::processMissingHHVMOutput($hack_file_path);
      }
      $output_title = 'Output';
      $output = \file_exists($hack_file_path.'.'.Files::HHVM_EXPECT)
        ? \file_get_contents($hack_file_path.'.'.Files::HHVM_EXPECT)
        : \file_get_contents($hack_file_path.'.'.Files::EXAMPLE_HHVM_OUT);
    }
    $output = Str\trim($output);

    $ret = vec[
      new Blocks\FencedCodeBlock('hack', Str\trim($files[$hack_filename])),
    ];
    if ($output !== '' && !C\contains_key($flags, Flags::NO_AUTO_OUTPUT)) {
      $ret[] = new Blocks\HTMLBlock('<em>'.$output_title.'</em>');
      $ret[] = new Blocks\FencedCodeBlock(null, $output);
    }
    return $ret;
  }

  private static function hasValidOutputFileSet(
    string $hack_file_path,
    Files $expect,
    Files $example,
    Files $expectf,
    Files $expectregex,
  ): bool {
    return \file_exists($hack_file_path.'.'.$expect) ||
      (
        \file_exists($hack_file_path.'.'.$example) &&
        (
          \file_exists($hack_file_path.'.'.$expectf) ||
          \file_exists($hack_file_path.'.'.$expectregex)
        )
      );
  }

  abstract protected static function processFile(
    string $name,
    string $content,
  ): void;

  abstract protected static function processMissingTypecheckerOutput(
    string $hack_filename,
  ): void;

  abstract protected static function processMissingHHVMOutput(
    string $hack_filename,
  ): void;
}
