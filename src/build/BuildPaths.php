<?hh // strict

namespace HHVM\UserDocumentation;

abstract final class BuildPaths {
  const string SYSTEMLIB_YAML = LocalConfig::BUILD_DIR.'/systemlib';
  const string HHI_YAML = LocalConfig::BUILD_DIR.'/hhi';
  const string MERGED_YAML = LocalConfig::BUILD_DIR.'/merged';

  const string GUIDES_HTML = LocalConfig::BUILD_DIR.'/guides';
  const string GUIDES_INDEX = self::GUIDES_HTML.'/index.php';

  const string BUILD_ID = LocalConfig::BUILD_DIR.'/build_id.txt';
}
