<?hh // strict

namespace HHVM\UserDocumentation;

abstract final class BuildPaths {
  const string SYSTEMLIB_YAML = LocalConfig::BUILD_DIR.'/systemlib-yaml';
  const string HHI_YAML = LocalConfig::BUILD_DIR.'/hhi-yaml';
  const string MERGED_YAML = LocalConfig::BUILD_DIR.'/merged-yaml';
  
  const string APIDOCS_MARKDOWN = LocalConfig::BUILD_DIR.'/api-markdown';
  const string APIDOCS_HTML = LocalConfig::BUILD_DIR.'/api-html';
  const string APIDOCS_INDEX = self::APIDOCS_HTML.'/index.php';

  const string GUIDES_HTML = LocalConfig::BUILD_DIR.'/guides-html';
  const string GUIDES_INDEX = self::GUIDES_HTML.'/index.php';
  const string GUIDES_SUMMARY = self::GUIDES_HTML.'/summary.php';

  const string STATIC_RESOURCES_MAP =
   LocalConfig::BUILD_DIR.'/static_resources.php';
  const string STATIC_RESOURCES_MAP_JSON =
   LocalConfig::BUILD_DIR.'/static_resources.json';

  const string BUILD_ID = LocalConfig::BUILD_DIR.'/build_id.txt';
}
