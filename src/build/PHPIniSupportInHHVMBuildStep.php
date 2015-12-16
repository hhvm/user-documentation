<?hh // strict

namespace HHVM\UserDocumentation;

final class PHPIniSupportInHHVMBuildStep extends BuildStep {
  use CodegenBuildStep;

  public function buildAll(): void {
    Log::i("\nPHPIniSupportInHHVM");

    $code = $this->writeCode(
      'PHPIniSupportInHHVM.hhi',
      $this->getIndexData(),
    );
    file_put_contents(
      BuildPaths::PHP_INI_SUPPORT_IN_HHVM,
      $code,
    );
  }


  private function getIndexData(): array<string, string> {
    // all the HHVM ini settings
    $settings = new Vector(array_keys(ini_get_all()));
    // The ones that are PHP settings (i.e., don't start with HHVM)
    $php_supported_settings = $settings->filter(
      $setting ==> strpos($setting, 'hhvm.') !== 0
    );
    $php_settings_with_urls = $this->getPHPSettingsWithURLs();

    $out = [];
    foreach ($php_supported_settings as $setting) {
      // default to here if no URL exists for specific setting
      $url = idx(
        $php_settings_with_urls,
        $setting,
      );
      if (!$url) {
        $url = 'http://php.net/manual/en/ini.list.php';
      } else {
        $url = sprintf(
          'http://php.net/manual/en/%s',
          $php_settings_with_urls[$setting]
        );
      }
      $out[$setting] = $url;
    }
    return $out;
  }

  private function getPHPSettingsWithURLs(): array<string, string> {
    // The HTML is not well formatted. We know that. Turn off outputting errors.
    libxml_use_internal_errors(true);
    // UNSAFE
    $dom = new \DomDocument();
    $html_content = \HH\Asio\join(
      \HH\Asio\curl_exec('http://php.net/manual/en/ini.list.php')
    );
    $dom->loadHTML($html_content);
    // UNSAFE
    $xpath = new \DomXPath($dom);
    // Query all the settings with URL references
    $nodes = $xpath->query("//tbody//tr//td//a");

    $settings = array();
    foreach ($nodes as $i => $node) {
      // settingName => URL
      $settings[$node->nodeValue] = $node->attributes->item(0)->nodeValue;
    }
    return $settings;
  }
}

