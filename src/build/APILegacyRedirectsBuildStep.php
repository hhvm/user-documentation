<?hh // strict

namespace HHVM\UserDocumentation;

final class APILegacyRedirectsBuildStep extends BuildStep {
  use CodegenBuildStep;

  /*  curl http://docs.hhvm.com/manual/en/search-index.json \
   *    > legacy-docs-site-index.json
   *
   * This file is committed instead of fetched as we expect that site to
   * be taken down soon.
   */
  const string LEGACY_INDEX = LocalConfig::ROOT.'/legacy-docs-site-index.json';

  public function buildAll(): void {
    Log::i("\nAPILegacyRedirectsBuild");
    $this->createIndex();
  }

  private function createIndex(
  ): void {
    $old_hack_docs_data = $this->generateOldHackDocsData();
    $php_dot_net_data = $this->generatePHPDotNetData();

    $index = $old_hack_docs_data;
    foreach ($php_dot_net_data as $id => $url) {
      $index[$id] = $url;
    }

    $code = $this->writeCode(
      'APILegacyRedirectData.hhi',
      $index,
    );
    file_put_contents(
      BuildPaths::APIDOCS_LEGACY_REDIRECTS,
      $code,
    );
  }

  private function generateOldHackDocsData(): array<string, string> {
    Log::v("\nProcessing old site index");
    $reader = new PHPDocsIndexReader(file_get_contents(self::LEGACY_INDEX));
    $old_classes = $reader->getClasses();
    $old_methods = $reader->getMethods();
    $old_functions = $reader->getFunctions();

    Log::v("\nCross-referencing with current site index");

    $old_ids_to_new_urls = [];

    $classes = (Map {})
      ->setAll(APIIndex::getClassIndex(APIDefinitionType::CLASS_DEF))
      ->setAll(APIIndex::getClassIndex(APIDefinitionType::INTERFACE_DEF))
      ->setAll(APIIndex::getClassIndex(APIDefinitionType::TRAIT_DEF));

    foreach ($classes as $class) {
      Log::v('.');
      $raw_name = $class['name'];
      $old_class_name = $raw_name;
      $old_id = idx($old_classes, $raw_name);

      if ($old_id === null) {
        $name_parts = explode("\\", $raw_name);
        $no_ns_name = $name_parts[count($name_parts) - 1];
        $old_class_name = $no_ns_name;
        $old_id = idx($old_classes, $no_ns_name);
      }

      if (!$old_id) {
        continue;
      }
      $old_ids_to_new_urls[$old_id] = $class['urlPath'];
      $old_class_id = $old_id;

      foreach ($class['methods'] as $method) {
        $old_id = idx($old_methods, $old_class_name.'::'.$method['name']);
        if ($old_id !== null) {
          $old_ids_to_new_urls[$old_id] = $method['urlPath'];
        }
      }
    }

    foreach (APIIndex::getFunctionIndex() as $function) {
      Log::v('.');
      $old_id = idx($old_functions, $function['name']);
      if ($old_id !== null) {
        $old_ids_to_new_urls[$old_id] = $function['urlPath'];
      }
    }

    return $old_ids_to_new_urls;
  }

  private function generatePHPDotNetData(): array<string, string> {
    Log::v("\nProcessing PHP.net index");
    $reader = new PHPDocsIndexReader(
      file_get_contents(BuildPaths::PHP_DOT_NET_INDEX_JSON)
    );
    $defs = $reader->getAllAPIDefinitions();

    $index = [];
    foreach ($defs as $_ => $id) {
      $url = sprintf('http://php.net/manual/en/%s.php', $id);
      $index[$id] = $url;
    }
    return $index;
  }
}
