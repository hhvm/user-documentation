<?hh // strict

use FredEmmott\TypeAssert\TypeAssert;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\LocalConfig;

final class Router extends RouterCodegenBase {
  <<__Override>>
  protected function getCacheFilePath(): ?string {
    if (LocalConfig::CACHE_ROUTES) {
      return BuildPaths::FASTROUTE_CACHE;
    }
    return null;
  }
}
