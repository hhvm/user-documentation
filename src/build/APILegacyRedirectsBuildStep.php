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

final class APILegacyRedirectsBuildStep extends BuildStep {
  use CodegenBuildStep;

  /*  curl http://docs.hhvm.com/manual/en/search-index.json \
   *    > legacy-docs-site-index.json
   *
   * This file is committed instead of fetched as we expect that site to
   * be taken down soon.
   */
  const string LEGACY_INDEX = LocalConfig::ROOT.'/legacy-docs-site-index.json';

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nAPILegacyRedirectsBuild");
    $this->createIndex();
  }

  private function createIndex(
  ): void {
    $old_hack_docs_data = $this->generateOldHackDocsData();

    $index = $old_hack_docs_data;

    $code = $this->writeCode(
      'APILegacyRedirectData.hhi',
      $index,
    );
    \file_put_contents(
      BuildPaths::APIDOCS_LEGACY_REDIRECTS,
      $code,
    );
  }

  private function generateOldHackDocsData(): array<string, string> {
    Log::v("\nProcessing old site index");
    $reader = new PHPDocsIndexReader(\file_get_contents(self::LEGACY_INDEX));
    $old_classes = $reader->getClasses();
    $old_methods = $reader->getMethods();
    $old_functions = $reader->getFunctions();

    Log::v("\nCross-referencing with current site index");

    $old_ids_to_new_urls = [];

    $index = APIIndex::get(APIProduct::HACK);

    $classes = (Map {})
      ->setAll($index->getClassIndex(APIDefinitionType::CLASS_DEF))
      ->setAll($index->getClassIndex(APIDefinitionType::INTERFACE_DEF))
      ->setAll($index->getClassIndex(APIDefinitionType::TRAIT_DEF));

    foreach ($classes as $class) {
      Log::v('.');
      $raw_name = $class['name'];
      $old_class_name = $raw_name;
      $old_id = idx($old_classes, $raw_name);

      if ($old_id === null) {
        $name_parts = \explode("\\", $raw_name);
        $no_ns_name = $name_parts[\count($name_parts) - 1];
        $old_class_name = $no_ns_name;
        $old_id = idx($old_classes, $no_ns_name);
      }

      if ($old_id === null) {
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

    foreach ($index->getFunctionIndex() as $function) {
      Log::v('.');
      $old_id = idx($old_functions, $function['name']);
      if ($old_id !== null) {
        $old_ids_to_new_urls[$old_id] = $function['urlPath'];
      }
    }

    return $old_ids_to_new_urls;
  }
}
