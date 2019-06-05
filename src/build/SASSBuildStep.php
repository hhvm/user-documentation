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

final class SASSBuildStep extends BuildStep {
  const string PROVIDER = LocalConfig::ROOT.'/sass/build.rb';

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nBuilding SASS");
    $css = null;
    $exit_code = null;
    \exec(self::PROVIDER, /* & */ &$css, /* & */ &$exit_code);
    invariant(
      $exit_code === 0,
      'Failed to build core CSS',
    );

    \file_put_contents(
      BuildPaths::CORE_CSS,
      $css,
    );
  }
}
