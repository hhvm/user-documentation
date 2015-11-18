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
    $index = $this->generateIndexData();

    $code = $this->writeCode(
      'APILegacyRedirectData.hhi',
      $index,
    );
    file_put_contents(
      BuildPaths::APIDOCS_LEGACY_REDIRECTS,
      $code,
    );
  }

  private function generateIndexData(): array<string, string> {
    $old_index = json_decode(file_get_contents(self::LEGACY_INDEX));
    $old_classes = [];
    $old_methods = [];
    $old_functions = [];

    Log::v("\nProcessing old site index");
    foreach ($old_index as $entry) {
      Log::v('.');
      list ($name, $id, $type) = $entry;

      $name = html_entity_decode($name);

      if ($type === 'phpdoc:classref') {
        $name = explode('<', $name)[0]; // remove generics
        $old_classes[$name] = $id;
        continue;
      }
      if ($type !== 'refentry') {
        continue;
      }
      $parts = (new Vector(explode('::', $name)))
        ->map($x ==> explode('<', $x)[0]);

      if (count($parts) === 1) {
        $old_functions[$parts[0]] = $id;
        continue;
      }

      invariant(
        count($parts) === 2,
        "Definition %s has %d parts",
        $name,
        count($parts),
      );

      $old_methods[implode('::', $parts)] = $id;
    }

    Log::v("\nCross-referencing with current site index");

    $old_ids_to_new_urls = [];

    $classes = (Map {})
      ->setAll(APIIndex::getClassIndex(APIDefinitionType::CLASS_DEF))
      ->setAll(APIIndex::getClassIndex(APIDefinitionType::INTERFACE_DEF))
      ->setAll(APIIndex::getClassIndex(APIDefinitionType::TRAIT_DEF));

    foreach ($classes as $class) {
      Log::v('.');
      $old_id = idx($old_classes, $class['name']);

      if ($old_id) {
        $old_ids_to_new_urls[$old_id] = $class['urlPath'];
      }

      foreach ($class['methods'] as $method) {
        $name = $class['name'].'::'.$method['name'];
        $old_id = idx($old_methods, $class['name'].'::'.$method['name']);
        if ($old_id) {
          $old_ids_to_new_urls[$old_id] = $method['urlPath'];
        }
      }
    }

    foreach (APIIndex::getFunctionIndex() as $function) {
      Log::v('.');
      $old_id = idx($old_functions, $function['name']);
      if ($old_id) {
        $old_ids_to_new_urls[$old_id] = $function['urlPath'];
      } 
    }

    return $old_ids_to_new_urls;
  }
}
