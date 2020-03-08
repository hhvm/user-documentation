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

use namespace HH\Lib\Dict;

final class SASSBuildStep extends BuildStep {
  const string PROVIDER = LocalConfig::ROOT.'/sass/build.rb';

  <<__Override>>
  public function buildAll(): void {
    \HH\Asio\join($this->buildAllAsync());
  }

  private async function buildAllAsync(): Awaitable<void> {
    Log::i("\nBuilding SASS");
    $exit_code = null;
    $options = shape(
      'environment' => dict[
        'GEM_HOME' => LocalConfig::ROOT.'/vendor-rb',
      ]
        |> Dict\merge($$, _Private\SuperGlobals\environment_variables()),
    );
    list($exit_code, $stdout, $stderr) = await _Private\execute_async(
      $options,
      self::PROVIDER,
    );
    invariant($exit_code === 0, 'Failed to build core CSS: %s', $stderr);

    \file_put_contents(BuildPaths::CORE_CSS, $stdout);
  }
}
