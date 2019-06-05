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

use function HHVM\UserDocumentation\Tests\execute_async;

final class RubyDependenciesBuildStep extends BuildStep {
  <<__Override>>
  public function buildAll(): void {
    \HH\Asio\join($this->buildAllAsync());
  }

  private async function buildAllAsync(): Awaitable<void> {
    Log::i("\nInstalling Ruby dependencies for SASS");

    // Check for ruby first to give a clear error
    list($exit_code, $_, $_) =  await execute_async(
      /* options = */ null,
      'ruby', '--version'
    );
    if ($exit_code !== 0) {
      throw new \Facebook\CLILib\ExitException(1, "ruby --version failed");
    }

    $ruby_root = LocalConfig::ROOT.'/vendor-rb';
    $bundler = $ruby_root.'/bin/bundle';
    $options = shape('environment' => dict[
      'GEM_HOME' => $ruby_root,
    ]);
    if (!\file_exists($bundler)) {
      Log::v("\nInstalling bundler");
      list($exit_code, $_, $_) = await execute_async($options, 'gem', 'install', 'bundler');
      if ($exit_code !== 0) {
        throw new \Facebook\CLILib\ExitException(1, 'gem install bundler failed');
      }
      invariant(\file_exists($bundler), "bundler executable not found");
    }
    if (\is_dir($ruby_root.'/ruby') && \file_exists(LocalConfig::ROOT.'/.bundle')) {
      return;
    }
    Log::v("\nInstalling dependencies using bundler");
    await execute_async($options, $bundler, 'install', '--path', $ruby_root);
    invariant(\is_dir($ruby_root.'/ruby') && \file_exists(LocalConfig::ROOT.'/.bundle'), "bundler failed");
  }
}
