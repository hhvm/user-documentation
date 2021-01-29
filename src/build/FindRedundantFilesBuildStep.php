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

namespace HHVM\UserDocumentation;

use namespace HH\Lib\{C, Str};

/**
 * Complain if there are any redundant files in build/extracted-examples/
 * (e.g. from removed example code blocks, or that people created manually).
 */
final class FindRedundantFilesBuildStep extends BuildStep {

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nFindRedundantFilesBuildStep\n");

    $ignored_globs = keyset['.', '..'];
    foreach (\file(LocalConfig::ROOT.'/.gitignore') as $line) {
      if (Str\contains($line, '*')) {
        $ignored_globs[] = Str\trim($line);
      }
    }

    $valid_files =
      MarkdownExt\ExtractedCodeBlocks\FilterBase::getAllValidFiles();

    $found_invalid = false;

    foreach (
      new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator(BuildPaths::EXAMPLES_EXTRACT_DIR),
      ) as $file_info
    ) {
      if (
        C\any(
          $ignored_globs,
          $glob ==> \fnmatch($glob, $file_info->getFilename()),
        )
      ) {
        continue;
      }

      if (!C\contains_key($valid_files, $file_info->getPathname())) {
        $found_invalid = true;
        Log::e(
          "Redundant file found: %s\n",
          Str\strip_prefix($file_info->getPathname(), LocalConfig::ROOT.'/'),
        );
      }
    }

    if ($found_invalid) {
      exit(1);
    }
  }
}
