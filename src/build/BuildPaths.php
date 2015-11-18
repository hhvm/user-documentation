<?hh // strict

namespace HHVM\UserDocumentation;

abstract final class BuildPaths {
  const string SYSTEMLIB_YAML = LocalConfig::BUILD_DIR.'/systemlib-yaml';
  const string HHI_YAML = LocalConfig::BUILD_DIR.'/hhi-yaml';
  const string MERGED_YAML = LocalConfig::BUILD_DIR.'/merged-yaml';
  
  const string APIDOCS_MARKDOWN = LocalConfig::BUILD_DIR.'/api-markdown';
  const string APIDOCS_HTML = LocalConfig::BUILD_DIR.'/api-html';
  const string APIDOCS_INDEX = LocalConfig::BUILD_DIR.'/api-index.php';
  const string APIDOCS_NAV_DATA = LocalConfig::BUILD_DIR.'/api-nav.js';

  const string GUIDES_MARKDOWN = LocalConfig::ROOT.'/guides';
  const string GUIDES_HTML = LocalConfig::BUILD_DIR.'/guides-html';
  const string GUIDES_INDEX = LocalConfig::BUILD_DIR.'/guides-index.php';
  const string GUIDES_SUMMARY = LocalConfig::BUILD_DIR.'/guides-summary.php';

  const string STATIC_RESOURCES_MAP =
   LocalConfig::BUILD_DIR.'/static_resources.php';
  const string STATIC_RESOURCES_MAP_JSON =
   LocalConfig::BUILD_DIR.'/static_resources.json';

  const string BUILD_ID = LocalConfig::BUILD_DIR.'/build_id.txt';
}
