<?hh // strict

namespace HHVM\UserDocumentation;

final class SearchResultSet {
    private Map<string, string> $classes;
    private Map<string, string> $functions;
    private Map<string, string> $interfaces;
    private Map<string, string> $hhvm_guides;
    private Map<string, string> $hack_guides;

    public function __construct() {
        $this->classes = Map {};
        $this->functions = Map {};
        $this->interfaces = Map {};
        $this->hhvm_guides = Map {};
        $this->hack_guides = Map {};
    }

    public function addAPIResult(string $type, string $name): void {
        if ($type === "class") {
            $this->classes[$name] = sprintf("/hack/reference/class/%s/", $name);
        }
        if ($type === "function") {
            $this->functions[$name] = sprintf("/hack/reference/function/%s/", $name);
        }
        if ($type === "interface") {
            $this->interfaces[$name] = sprintf("/hack/reference/interface/%s/", $name);
        }
    }

    public function addGuideResult(string $type, string $category, string $name): void {
        if ($type === "hhvm") {
            $this->hhvm_guides[ucwords("{$category} {$name}")] = "/hhvm/{$category}/{$name}";
        }
        if ($type === "hack") {
            $this->hack_guides[ucwords("{$category} {$name}")] = "/hack/{$category}/{$name}";
        }
    }

    public function getClasses(): Map<string, string> {
        return $this->classes;
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
