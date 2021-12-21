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

namespace HHVM\UserDocumentation\ExampleTypechecker;

use namespace HH\Lib\{PseudoRandom, Regex, Str};
use type HHVM\UserDocumentation\LocalConfig;
use function HHVM\UserDocumentation\_Private\execute_async;

async function typecheck_example_async(
  string $in_file,
): Awaitable<(string, string)> {
  $source_dir = \dirname($in_file);
  await using $tmp_dir = new TemporaryDirectory();
  await using $hh_tmp_dir = new TemporaryDirectory();
  $work_dir = $tmp_dir->getPath();

  \copy(
    $in_file,
    $work_dir.'/'.Str\strip_suffix(\basename($in_file), '.type-errors'),
  );

  $hhconfig = \file_exists($in_file.'.hhconfig')
    ? \file_get_contents($in_file.'.hhconfig')."\n"
    : '';
  if (
    !Str\contains($hhconfig, 'allowed_decl_fixme_codes') &&
    !Str\contains($hhconfig, 'allowed_fixme_codes_strict')
  ) {
    $hhconfig .= get_hhconfig_whitelists();
  }
  \file_put_contents($work_dir.'/.hhconfig', $hhconfig);

  foreach (\glob($source_dir.'/*.inc.php') as $include_file) {
    \copy($include_file, $work_dir.'/'.\basename($include_file));
  }

  $hh_server_path = get_hh_server_path();
  invariant($hh_server_path is nonnull, "Couldn't find hh_server");

  // HHVM_DISABLE_PERSONALITY: `hh_server` tries to disable ASLR via the
  // `personality()` syscall, which fails in Docker.
  list($_exit_code, $stdout, $stderr) = await execute_async(
    shape(
      'environment' => dict[
        'HH_TMPDIR' => $hh_tmp_dir->getPath(),
        'HHVM_DISABLE_PERSONALITY' => '1',
      ],
    ),
    $hh_server_path,
    '--check',
    '--max-procs=1',
    '--config',
    'extra_paths='.LocalConfig::ROOT.'/vendor/',
    $work_dir,
  );

  return tuple($stdout, $stderr);
}

<<__Memoize>>
function get_hhconfig_whitelists(): string {
  $hhconfig = \file_get_contents(LocalConfig::ROOT.'/.hhconfig');
  $ret = '';
  foreach (
    vec[
      re"/^allowed_decl_fixme_codes=.*\$/m",
      re"/^allowed_fixme_codes_strict=.*\$/m",
    ] as $regex
  ) {
    $m = Regex\first_match($hhconfig, $regex);
    if ($m is nonnull) {
      $ret .= $m[0]."\n";
    }
  }
  return $ret;
}

<<__Memoize>>
function get_hh_server_path(): ?string {
  $hh_server = \dirname(\PHP_BINARY).'/hh_server';
  if (\file_exists($hh_server)) {
    return $hh_server;
  }

  foreach (Str\split(\getenv('PATH'), ':') as $dir) {
    $hh_server = $dir.'/hh_server';
    if (\file_exists($hh_server)) {
      return $hh_server;
    }
  }
  return null;
}

final class TemporaryDirectory implements \IAsyncDisposable {
  private string $path;
  public function __construct() {
    $this->path = \sys_get_temp_dir().
      '/hack-tests-'.
      \bin2hex(PseudoRandom\string(16));
    \mkdir($this->path);
  }

  public function getPath(): string {
    return $this->path;
  }

  public async function __disposeAsync(): Awaitable<void> {
    await execute_async(null, 'rm', '-rf', '--', $this->path);
  }
}
