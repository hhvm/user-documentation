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

namespace HHVM\UserDocumentation\GFM;

use namespace Facebook\GFM\{Inlines, UnparsedBlocks};

use namespace HH\Lib\{C, Str, Vec};

final class ExamplesIncludeBlock extends UnparsedBlocks\Block {
  const string PATTERN =
    '/^@@ (?<dir>[^@ ]+)'.
    '(?<file>[^@ \\/]+\\.php'.
      '(?:.type-errors)?'.
      '(?:.(hhvm|typechecker).expect[f]?)?'.
    ') @@$/';

  public static function consume(
    UnparsedBlocks\Context $context,
    vec<string> $lines,
  ): ?(UnparsedBlocks\Block, vec<string>) {
    $first = C\firstx($lines);
    $matches = [];
    if (\preg_match(self::PATTERN, $first, $matches) !== 1) {
      return null;
    }

    $dir = (string) $matches['dir'];
    $file = (string) $matches['file'];

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
      Vec\drop($lines, 1),
    );
  }

  public function withParsedInlines(
    Inlines\Context $_,
  ): \Facebook\GFM\Blocks\Block {
    invariant_violation('should never be called');
  }

  private static function getExampleBlock(string $file): UnparsedBlocks\Block {
    return new UnparsedBlocks\FencedCodeBlock(
      \file_get_contents($file),
      'Hack',
    );
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
      $out, $expect,
    );

    invariant(
      $out_exists || $expect_exists || Str\contains($file, '.inc.php'),
      'none of %s, %s, or %s exist.',
      $out, $expect, $file.'.no.auto.output',
    );
    if (!($out_exists || $expect_exists)) {
      return null;
    }

    $out = $out_exists ? $out : $expect;

    return UnparsedBlocks\BlockSequence::flatten(
      new UnparsedBlocks\HTMLBlock('<em>Output</em>'),
      new UnparsedBlocks\FencedCodeBlock(\file_get_contents($out), null),
    );
  }
}
