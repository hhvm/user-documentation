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
  <<__Override>>
  public function buildAll(): void {
    \HH\Asio\join($this->buildAllAsync());
  }

  private async function buildAllAsync(): Awaitable<void> {
    Log::i("\nBuilding SASS...");
    $exit_code = null;
    list($exit_code, $stdout, $stderr) = await _Private\execute_async(
      null,
      SASSDependenciesBuildStep::getDartSASSExecutablePath(),
      '--load-path='.LocalConfig::ROOT.'/sass',
      '--load-path='.SASSDependenciesBuildStep::getFontAwesomeDir().'/scss',
      LocalConfig::ROOT.'/sass/core.scss',
      BuildPaths::CORE_CSS,
    );
    invariant($exit_code === 0, "Failed to build core CSS: %s%s", $stdout,$stderr);
  }
}
