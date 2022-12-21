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
use function HHVM\UserDocumentation\_Private\execute_async;

final class SASSDependenciesBuildStep extends BuildStep {
  const type TPlatformConfig = shape(
    'platform' => string,
    'url' => string,
    'sha256' => string,
  );

  public static function getPlatformConfiguration(): self::TPlatformConfig {
    if (\HH\Lib\_Private\_OS\IS_MACOS) {
      return shape(
        'platform' => 'macos-x64',
        'url' =>
          'https://github.com/sass/dart-sass/releases/download/1.47.0/dart-sass-1.47.0-macos-x64.tar.gz',
        'sha256' =>
          '456392668cdd538f8c403e5b9cdd675cc9d7e9b7a8c0a6239a9114e114f2fa0d',
      );
    }

    return shape(
      'platform' => 'linux-x64',
      'url' =>
        'https://github.com/sass/dart-sass/releases/download/1.47.0/dart-sass-1.47.0-linux-x64.tar.gz',
      'sha256' =>
        '8e736455d56fb36f01904c5f24df0f98392eca090a1f2b666ac0985dd50d47c5',
    );
  }

  private static function getDartSASSExecutableDir(): string {
    $config = self::getPlatformConfiguration();
    return BuildPaths::FINAL_DIR.
      '/dart-sass-'.
      $config['platform'].
      '-'.
      Str\slice(self::getPlatformConfiguration()['sha256'], 0, 8);
  }

  public static function getDartSASSExecutablePath(): string {
    return self::getDartSASSExecutableDir().'/sass';
  }

  <<__Override>>
  public function buildAll(): void {
    \HH\Asio\join(async {
      concurrent {
        await self::installDartSASSAsync();
        await self::installFontAwesomeAsync();
      }
    });
  }

  public static function getFontAwesomeDir(): string {
    return BuildPaths::FINAL_DIR.'/fontawesome-free-5.15.4-web';
  }

  private static async function installFontAwesomeAsync(): Awaitable<void> {
    $dir = self::getFontAwesomeDir();
    $test_file = $dir.'/scss/_core.scss';
    if (\file_exists($test_file)) {
      Log::i("\nfont-awesome already installed.");
      return;
    }
    Log::i("\nInstalling font-awesome...");

    $url = 'https://github.com/FortAwesome/Font-Awesome/releases/download/5.15.4/fontawesome-free-5.15.4-web.zip';
    $zip_file_name = C\lastx(Str\split($url, '/'));
    $zip_file_path = BuildPaths::SCRATCH_DIR.'/'.$zip_file_name;

    await self::downloadAndVerifyAsync($url, $zip_file_path, 'b9554077f70ac13c2e687e30d0fef15d5b64852b04b2a87fdb35f3edec395ae7');
    await execute_async(
      shape('working_directory' => \dirname($dir)),
      'unzip',
      $zip_file_path,
    );

    if (!\file_exists($test_file)) {
      throw new \Exception('Failed to extract Font-Awesome - was looking for '.$test_file);
    }
  }

  private static async function downloadAndVerifyAsync(
    string $url,
    string $path,
    string $expected_sha256,
  ): Awaitable<void> {
    await execute_async(null, 'wget', '-O', $path, $url);
    $actual_sha256 = \hash('sha256', \file_get_contents($path));
    if ($actual_sha256 !== $expected_sha256) {
      throw new \Exception(Str\format(
        'Hash of "%s" does not match: expected "%s", got "%s"',
        $url,
        $expected_sha256,
        $actual_sha256,
      ));
    }

  }

  private static async function installDartSASSAsync(): Awaitable<void> {
    if (\is_executable(self::getDartSASSExecutablePath())) {
      Log::i("\nDartSASS is already installed.");
      return;
    }
    Log::i("\nInstalling DartSASS for SASS...");
    $config = self::getPlatformConfiguration();
    $tar_name = C\lastx(Str\split($config['url'], '/'));
    $tar_path = BuildPaths::SCRATCH_DIR.'/'.$tar_name;

    await self::downloadAndVerifyAsync(
      $config['url'],
      $tar_path,
      $config['sha256'],
    );

    $dir = self::getDartSASSExecutableDir();
    if (!\is_dir($dir)) {
      \mkdir($dir);
    }
    await execute_async(
      shape('working_directory' => $dir),
      'tar',
      '-zxvf',
      $tar_path,
      '--strip-components',
      '1',
    );
    if (!\file_exists(self::getDartSASSExecutablePath())) {
      throw new \Exception('Failed to extract SASS binary');
    }
  }
}
