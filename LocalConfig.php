<?hh // strict

namespace HHVM\UserDocumentation;

abstract final class LocalConfig {
  const string ROOT = __DIR__;

  const string BUILD_DIR = self::ROOT.'/build';
  const string HHVM_TREE = self::ROOT.'/../hhvm';
}
