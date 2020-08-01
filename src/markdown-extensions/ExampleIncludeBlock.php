<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation\MarkdownExt;

use namespace Facebook\Markdown\UnparsedBlocks;

use namespace HH\Lib\{C, Keyset, Regex, Str};

final class ExamplesIncludeBlock implements UnparsedBlocks\BlockProducer {

  const START_MARKER = '@example-start';
  const END_MARKER = '@example-end';

  const string PATTERN = '/^@@ (?<dir>[^@ ]+)'.
    '(?<file>[^@ \\/]+\\.(php|hack)'.
    '(?:.type-errors)?'.
    '(?:.(hhvm|typechecker).expect[f]?)?'.
    ') @@$/';

  public static function consume(
    UnparsedBlocks\Context $context,
    UnparsedBlocks\Lines $lines,
  ): ?(UnparsedBlocks\Block, UnparsedBlocks\Lines) {
    list($first, $rest) = $lines->getFirstLineAndRest();
    $matches = darray[];
    if (\preg_match_with_matches(self::PATTERN, $first, inout $matches) !== 1) {
      return null;
    }

    $dir = (string)$matches['dir'];
    $file = (string)$matches['file'];

    if (Str\starts_with($dir, '/')) {
      $file = $dir.$file;
    } else {
      $md = $context->getFilePath();
      invariant($md !== null, 'must have file path set on block context');
      $root = \dirname($md);
      $subdir = Str\strip_suffix(\basename($md), '.md');

      // 01-foo/examples/bar.php is referenced in the markdown as
      // foo/examples/bar.php, to make re-ordering easier
      $match = Str\trim_left($subdir, '1234567890-');
      if (!Str\starts_with($dir, $match)) {
        return null;
      }

      $file = $root.'/'.$subdir.Str\strip_prefix($dir, $match).$file;
    }


    invariant(
      \file_exists($file),
      'failed to find file %s, referenced by %s',
      $file,
      $context->getFilePath(),
    );

    return tuple(
      UnparsedBlocks\BlockSequence::flatten(
        self::getExampleBlock($file),
        self::getOutputBlock($file),
      ),
      $rest,
    );
  }

  private static function getExampleBlock(string $file): UnparsedBlocks\Block {
    $code = \file_get_contents($file);

    $start_pos = Str\search($code, self::START_MARKER);
    if ($start_pos is nonnull) {
      // Actual start should be the next line after the marker.
      $start_pos = Str\search($code, "\n", $start_pos) as nonnull;
      $code = Str\slice($code, $start_pos + 1);

      invariant(
        !Str\contains($code, self::START_MARKER),
        '%s contains multiple %s',
        $file,
        self::START_MARKER,
      );

      $end_pos = Str\search($code, self::END_MARKER);
      if ($end_pos is nonnull) {
        $code = Str\slice($code, 0, $end_pos);
        // Actual end should be the end of the previous line before the marker.
        $end_pos = Str\search_last($code, "\n") as nonnull;
        $code = Str\slice($code, 0, $end_pos + 1);
      }
    } else {
      // No explicit start marker, use magic.

      // First, strip initial boilerplate lines (<?hh/namespace/use/empty).
      $code = Regex\replace(
        $code,
        re"/^( *(<\\?hh.*|namespace .+;|use namespace HH\\\\.+;|)\n)+/",
        '',
      );

      // If the remaining code is a single <<__EntryPoint>> function, extract
      // its body.
      $match = Regex\first_match(
        $code,
        re"/^
          \\s*
          <<__EntryPoint>>
          \\s*
          function \\s+ [_a-zA-Z0-9]+\\(\\): \\s* void \\s* { \\n
            (?<body>
              # one or more indented or empty lines
              (\\ \\ .*\\n|\\n)+
            )
          }
          \\s*
        $/x",
      );

      if ($match is nonnull) {
        $code = $match['body'];
      }
    }

    invariant(
      !Str\contains($code, self::END_MARKER),
      '%s contains %s without a matching %s',
      $file,
      self::END_MARKER,
      self::START_MARKER,
    );

    // If all (non-empty) lines are indented (usually happens if we extracted a
    // function body above), find the minimum indentation and unindent by that
    // amount.
    if (!Regex\matches($code, re"/^[^ \n]/m")) {
      $code = Regex\every_match($code, re"/^ +/m")
        |> Keyset\map($$, $match ==> $match[0])
        |> Keyset\sort($$)
        |> C\firstx($$)
        |> Str\replace($code, "\n".$$, "\n");
    }

    $code = Regex\replace($code, re"/ *\\\\__init_autoload\\(\\);\n/", '');

    return new UnparsedBlocks\FencedCodeBlock(Str\trim($code), 'Hack');
  }

  private static function getOutputBlock(string $file): ?UnparsedBlocks\Block {
    if (\file_exists($file.'.no.auto.output')) {
      return null;
    }

    $out = $file.'.example.hhvm.out';
    $expect = $file.'.hhvm.expect';

    $out_exists = \file_exists($out);
    $expect_exists = \file_exists($expect);

    invariant(
      !($out_exists && $expect_exists),
      'both %s and %s exist.',
      $out,
      $expect,
    );

    invariant(
      $out_exists || $expect_exists || Str\contains($file, '.inc.php'),
      'none of %s, %s, or %s exist.',
      $out,
      $expect,
      $file.'.no.auto.output',
    );
    if (!($out_exists || $expect_exists)) {
      return null;
    }

    $out = $out_exists ? $out : $expect;

    return UnparsedBlocks\BlockSequence::flatten(
      new UnparsedBlocks\HTMLBlock('<em>Output</em>'),
      new UnparsedBlocks\FencedCodeBlock(
        Str\trim(\file_get_contents($out)),
        null,
      ),
    );
  }
}
