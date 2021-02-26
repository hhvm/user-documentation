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

use namespace HH\Lib\{Str, Vec};

final class PHPIniSupportInHHVMBuildStep extends BuildStep {

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nPHPIniSupportInHHVM");

    \file_put_contents(
      BuildPaths::PHP_INI_SUPPORT_IN_HHVM_JSON,
      JSON\encode_dict($this->getIndexData()),
    );
  }


  private function getIndexData(): dict<string, string> {
    // all the HHVM ini settings
    $settings = Vec\keys(\ini_get_all());
    // The ones that are PHP settings (i.e., don't start with HHVM)
    $php_supported_settings = Vec\filter(
      $settings,
      $setting ==> !Str\contains($setting, 'hhvm.'),
    );
    // Remove curl.namedPools, which is not a PHP setting
    $php_supported_settings = Vec\filter(
      $php_supported_settings,
      $php_supported_settings ==> !Str\contains($php_supported_settings, 'curl.namedPools'),
    );
    $php_settings_with_urls = $this->getPHPSettingsWithURLs();

    $out = dict[];
    foreach ($php_supported_settings as $setting) {
      // default to here if no URL exists for specific setting
      $url = idx($php_settings_with_urls, $setting);
      if ($url === null) {
        $url = 'http://php.net/manual/en/ini.list.php';
      } else {
        $url = \sprintf(
          'http://php.net/manual/en/%s',
          $php_settings_with_urls[$setting],
        );
      }
      $out[$setting] = $url;
    }
    return $out;
  }

  private function getPHPSettingsWithURLs(): dict<string, string> {
    // The HTML is not well formatted. We know that. Turn off outputting errors.
    \libxml_use_internal_errors(true);
    $dom = new \DOMDocument();
    $html_content = \HH\Asio\join(
      \HH\Asio\curl_exec('http://php.net/manual/en/ini.list.php'),
    );
    $dom->loadHTML($html_content);
    $xpath = new \DOMXPath($dom);
    // Query all the settings with URL references
    $nodes = $xpath->query("//tbody//tr//td//a");

    $settings = dict[];
    foreach ($nodes as $node) {
      // settingName => URL
      $settings[$node->nodeValue] = $node->attributes->item(0)->nodeValue;
    }
    return $settings;
  }
}
