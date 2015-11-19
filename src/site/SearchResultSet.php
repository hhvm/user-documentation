<?hh // strict

namespace HHVM\UserDocumentation;

final class SearchResultSet {
  private Map<string, string> $classes = Map {};
  private Map<string, string> $functions = Map {};
  private Map<string, string> $interfaces = Map {};
  private Map<string, string> $traits = Map {};
  private Map<string, string> $hhvm_guides = Map {};
  private Map<string, string> $hack_guides = Map {};

  public function addAPIResult(APIDefinitionType $type, string $name): void {
    switch ($type) {
      case APIDefinitionType::TRAIT_DEF:
        $this->traits[$name] = sprintf("/hack/reference/trait/%s/", $name);
        break;
      case APIDefinitionType::INTERFACE_DEF:
        $this->interfaces[$name] = sprintf("/hack/reference/interface/%s/", $name);
        break;
      case APIDefinitionType::FUNCTION_DEF:
        $this->functions[$name] = sprintf("/hack/reference/function/%s/", $name);
        break;
      case APIDefinitionType::CLASS_DEF:
        $this->classes[$name] = sprintf("/hack/reference/class/%s/", $name);
        break;
    }
  }

  public function addGuideResult(string $type, string $category, string $name): void {
    switch (GuideDefinitionType::assert($type)) {
      case GuideDefinitionType::HHVM_DEF:
        $this->hhvm_guides[ucwords("{$category} {$name}")] = "/hhvm/{$category}/{$name}";
        break;
      case GuideDefinitionType::HACK_DEF:
        $this->hack_guides[ucwords("{$category} {$name}")] = "/hack/{$category}/{$name}";
        break;
    }
  }

  public function getClasses(): Map<string, string> {
    return $this->classes;
  }

  public function getTraits(): Map<string, string> {
    return $this->traits;
  }

  public function getInterfaces(): Map<string, string> {
    return $this->interfaces;
  }

  public function getFunctions(): Map<string, string> {
    return $this->functions;
  }

  public function getHackGuides(): Map<string, string> {
    return $this->hack_guides;
  }

  public function getHHVMGuides(): Map<string, string> {
    return $this->hhvm_guides;
  }
}
