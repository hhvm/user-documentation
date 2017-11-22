<?hh // strict

namespace HHVM\UserDocumentation;

use namespace HH\Lib\Str;

abstract final class LocalConfig {
  const string ROOT = __DIR__;

  <<__Memoize>>
  public static function getBuildID(): string {
    invariant(
      \file_exists(BuildPaths::BUILD_ID_FILE),
      "Build ID does not exist",
    );
    return Str\trim(\file_get_contents(BuildPaths::BUILD_ID_FILE));
  }
}
