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

abstract final class BuildPaths {
  const string API_SOURCES_DIR = LocalConfig::ROOT.'/api-sources';
  const string HHVM_TREE = self::API_SOURCES_DIR.'/hhvm';
  const string HSL_TREE = self::API_SOURCES_DIR.'/hsl';
  const string HSL_EXPERIMENTAL_TREE =
    LocalConfig::ROOT.'/api-sources/hsl-experimental';

  const string BUILD_ROOT_DIR = LocalConfig::ROOT.'/build';
  const string SCRATCH_DIR = self::BUILD_ROOT_DIR.'/scratch';
  const string FINAL_DIR = self::BUILD_ROOT_DIR.'/final';
  const string CODEGEN_DIR = self::FINAL_DIR.'/codegen';

  const string DIR_INDEX_ROOT = self::SCRATCH_DIR.'/dir-index';

  const string SYSTEMLIB_YAML =
    self::SCRATCH_DIR.'/unmerged-api-data/systemlib';
  const string HHI_YAML = self::SCRATCH_DIR.'/unmerged-api-data/hhi';

  const string APIDOCS_DATA = self::SCRATCH_DIR.'/api-data';
  const string APIDOCS_MARKDOWN = self::SCRATCH_DIR.'/api-markdown';
  const string APIDOCS_HTML = self::FINAL_DIR.'/api-html';
  const string APIDOCS_INDEX_JSON = self::FINAL_DIR.'/api-index.json';
  const string APIDOCS_TAG = self::FINAL_DIR.'/.api.tag';
  const string APIDOCS_LEGACY_REDIRECTS =
    self::CODEGEN_DIR.'/api-legacy-redirects.php';

  const string API_EXAMPLES_DIR = LocalConfig::ROOT.'/api-examples';
  const string API_EXAMPLES_EXTRACT_DIR = self::API_EXAMPLES_DIR.'/_extracted';

  const string GUIDES_MARKDOWN = LocalConfig::ROOT.'/guides';
  const string GUIDES_GENERATED_MARKDOWN =
    self::SCRATCH_DIR.'/guides-generated-markdown';
  const string GUIDES_HTML = self::FINAL_DIR.'/guides-html';
  const string GUIDES_INDEX = self::CODEGEN_DIR.'/guides-index.php';
  const string GUIDES_SUMMARY = self::CODEGEN_DIR.'/guides-summary.php';

  // FooBar => URL (for markdown)
  const string UNIFIED_INDEX = self::CODEGEN_DIR.'/unified-index.php';
  // foobar => URL (for /j/ URLs)
  const string JUMP_INDEX = self::CODEGEN_DIR.'/jump-index.php';

  const string PHP_INI_SUPPORT_IN_HHVM_JSON =
    self::FINAL_DIR.'/php-ini-support-in-hhvm.json';

  const string CORE_CSS = self::FINAL_DIR.'/main.css';
  const string SITE_MAP = self::FINAL_DIR.'/sitemap.txt';

  const string STATIC_RESOURCES_MAP_JSON =
    self::FINAL_DIR.'/static_resources.json';
  const string FB_IP_RANGES_JSON = self::FINAL_DIR.'/fb_ip_ranges.json';

  const string BUILD_ID_FILE = self::FINAL_DIR.'/build_id.txt';
}
