<?hh // strict

use FredEmmott\TypeAssert\TypeAssert;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\LocalConfig;

final class Router extends RouterCodegenBase {
  <<__Override>>
  protected function getCacheFilePath(): ?string {
    if (\Facebook\AutoloadMap\Generated\is_dev()) {
      return null;
    }
    return BuildPaths::FASTROUTE_CACHE;
  }
}
