<?hh // strict

namespace HHVM\UserDocumentation;

abstract final class BuildPaths {
  const string HHVM_TREE = LocalConfig::ROOT.'/api-sources/hhvm';
  const string HSL_TREE = LocalConfig::ROOT.'/api-sources/hsl';

  const string BUILD_DIR = LocalConfig::ROOT.'/build';

  const string SYSTEMLIB_YAML = self::BUILD_DIR.'/systemlib-yaml';
  const string HHI_YAML = self::BUILD_DIR.'/hhi-yaml';
  const string HSL_YAML = self::BUILD_DIR.'/hsl-yaml';
  const string MERGED_YAML = self::BUILD_DIR.'/merged-yaml';

  const string APIDOCS_MARKDOWN = self::BUILD_DIR.'/api-markdown';
  const string APIDOCS_HTML = self::BUILD_DIR.'/api-html';
  const string APIDOCS_INDEX = self::BUILD_DIR.'/api-index.php';
  const string APIDOCS_LEGACY_REDIRECTS
    = self::BUILD_DIR.'/api-legacy-redirects.php';

  const string PHP_DOT_NET_INDEX_JSON =
    self::BUILD_DIR.'/php-dot-net-index.json';

  const string GUIDES_MARKDOWN = LocalConfig::ROOT.'/guides';
  const string GUIDES_GENERATED_MARKDOWN
    = self::BUILD_DIR.'/guides-generated-markdown';
  const string GUIDES_HTML = self::BUILD_DIR.'/guides-html';
  const string GUIDES_INDEX = self::BUILD_DIR.'/guides-index.php';
  const string GUIDES_SUMMARY = self::BUILD_DIR.'/guides-summary.php';

  // FooBar => URL (for markdown)
  const string UNIFIED_INDEX_JSON
    = self::BUILD_DIR.'/unified-index.json';
  // foobar => URL (for /j/ URLs)
  const string JUMP_INDEX
    = self::BUILD_DIR.'/jump-index.php';

  const string PHP_DOT_NET_API_INDEX
    = self::BUILD_DIR.'/php-dot-net-api-index.php';
  const string PHP_DOT_NET_ARTICLE_REDIRECTS
    = self::BUILD_DIR.'/php-dot-net-article-redirects.php';
  const string PHP_INI_SUPPORT_IN_HHVM
    = self::BUILD_DIR.'/php-ini-support-in-hhvm.php';

  const string CORE_CSS = self::BUILD_DIR.'/main.css';
  const string SYNTAX_HIGHLIGHT_CSS =
    self::BUILD_DIR.'/syntax-highlighting.css';
  const string SITE_MAP = self::BUILD_DIR.'/sitemap.txt';

  const string STATIC_RESOURCES_MAP =
   self::BUILD_DIR.'/static_resources.php';
  const string STATIC_RESOURCES_MAP_JSON =
   self::BUILD_DIR.'/static_resources.json';

  const string FASTROUTE_CACHE =
    self::BUILD_DIR.'/route.cache';

  const string BUILD_ID = self::BUILD_DIR.'/build_id.txt';
}
