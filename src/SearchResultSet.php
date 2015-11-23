<?hh // strict

namespace HHVM\UserDocumentation;

final class SearchResultSet {
  private Map<APIDefinitionType, Map<string, APIIndexEntry>> $apiDefs = Map { };
  private Map<string, string> $hhvmGuides = Map {};
  private Map<string, string> $hackGuides = Map {};

  public function __construct() {
    foreach (APIDefinitionType::getValues() as $type) {
      $this->apiDefs[$type] = Map { };
    }
  }

  public function addAPIResult(
    APIDefinitionType $type,
    APIIndexEntry $entry,
  ): void {
    $this->apiDefs[$type][$entry['name']] = $entry;
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
    }
    $this->hhvmGuides->setAll($other->hhvmGuides);
    $this->hackGuides->setAll($other->hackGuides);

    return $this;
  }

  public function getClasses(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::CLASS_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getTraits(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::TRAIT_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getInterfaces(): Map<string, string> {
    return $this->apiDefs[APIDefinitionType::INTERFACE_DEF]->map(
      $entry ==> $entry['urlPath'],
    );
  }

  public function getFunctions(): Map<string, string> {
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
}
