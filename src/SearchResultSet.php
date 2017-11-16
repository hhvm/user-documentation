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

final class SearchResultSet {
  private Map<APIDefinitionType, Map<string, APIIndexEntry>> $apiDefs = Map { };
  private Map<string, string> $hhvmGuides = Map {};
  private Map<string, string> $hackGuides = Map {};
  private Map<APIDefinitionType, Map<string, string>> $phpApiDefs= Map { };

  public function __construct() {
    foreach (APIDefinitionType::getValues() as $type) {
      $this->apiDefs[$type] = Map { };
      $this->phpApiDefs[$type] = Map { };
    }
  }

  public function addAPIResult(
    APIDefinitionType $type,
    APIIndexEntry $entry,
  ): void {
    $this->apiDefs[$type][$entry['name']] = $entry;
  }

  public function addPHPAPIResult(
    APIDefinitionType $type,
    string $name,
    string $url,
  ): void {
    $this->phpApiDefs[$type][$name] = $url;
  }

  public function addGuideResult(
    GuidesProduct $product,
    string $guide,
    string $page,
  ): void {
    $name = Guides::normalizeName($product, $guide, $page);
    $url = URLBuilder::getPathForGuidePage($product, $guide, $page);
    switch ($product) {
      case GuidesProduct::HHVM:
        $this->hhvmGuides[$name] = $url;
        break;
      case GuidesProduct::HACK:
        $this->hackGuides[$name] = $url;
        break;
    }
  }

  public function addAll(SearchResultSet $other): this {
    foreach (APIDefinitionType::getValues() as $type) {
      $this->apiDefs[$type]->setAll($other->apiDefs[$type]);
      $this->phpApiDefs[$type]->setAll($other->phpApiDefs[$type]);
    }
    $this->hhvmGuides->setAll($other->hhvmGuides);
    $this->hackGuides->setAll($other->hackGuides);

    return $this;
  }

  public function getHackClasses(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::CLASS_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getHackTraits(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::TRAIT_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getHackInterfaces(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::INTERFACE_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getHackFunctions(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::FUNCTION_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getHackGuides(): Map<string, string> {
    return $this->hackGuides;
  }

  public function getHHVMGuides(): Map<string, string> {
    return $this->hhvmGuides;
  }

  public function getPHPClasses(): Map<string, string> {
    return $this->phpApiDefs[APIDefinitionType::CLASS_DEF];
  }

  public function getPHPFunctions(): Map<string, string> {
    return $this->phpApiDefs[APIDefinitionType::FUNCTION_DEF];
  }
}
