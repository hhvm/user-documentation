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

/**
 * @see FilterBase
 * This subclass should be used from CI or other automated builds.
 *
 * Verifies that files extracted from code blocks exist and have the correct
 * content, but never writes anything. For HHVM/typechecker output files, only
 * their existence is verified (content is verified in ExamplesTest).
 */
final class VerifyFilter extends FilterBase {

  const FIX = 'Run `hhvm bin/build.php` and commit all generated files.';

  <<__Override>>
  protected static function processFile(string $path, string $content): void {
    invariant(\file_exists($path), '%s is missing. %s', $path, self::FIX);
    invariant(
      \file_get_contents($path) === $content,
      '%s is outdated. %s',
      $path,
      self::FIX,
    );
  }

  <<__Override>>
  protected static function processMissingTypecheckerOutput(
    string $hack_file_path,
    bool $_needs_example,
  ): void {
    invariant_violation(
      'No typechecker output files found for %s. %s',
      $hack_file_path,
      self::FIX,
    );
  }

  <<__Override>>
  protected static function processMissingHHVMOutput(
    string $hack_file_path,
    bool $_needs_example,
  ): void {
    invariant_violation(
      'No output files found for %s. %s',
      $hack_file_path,
      self::FIX,
    );
  }
}
