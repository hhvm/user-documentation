<?hh // strict

namespace HHVM\UserDocumentation;

// Index of all definitions, so that markdown processing can
// automatically linkify them
final class UnifiedAPIIndexBuildStep extends BuildStep {
  use CodegenBuildStep;

  public function buildAll(): void {
    Log::i("\nUnifiedAPIIndexBuildStep");

    $defs = new Map($this->getPHPAPILinks());
    $defs->setAll($this->getHackAPILinks());

    file_put_contents(
      BuildPaths::UNIFIED_INDEX_JSON,
      json_encode($defs, JSON_PRETTY_PRINT)
    );

    $jump_index = [];
    foreach ($defs as $name => $url) {
      $jump_index[strtolower($name)] = $url;
    }

    $code = $this->writeCode(
      'JumpIndexData.hhi',
      $jump_index,
    );
    file_put_contents(
      BuildPaths::JUMP_INDEX,
      $code,
    );
  }

  private function getHackAPILinks(): ImmMap<string, string> {
    Log::v("\nProcessing Hack API Index");

    $out = Map { };
    foreach (APIDefinitionType::getValues() as $type) {
      $defs = APIIndex::getIndexForType($type);
      foreach ($defs as $_ => $def) {
        $name = $def['name'];
        $out[$name] = $def['urlPath'];
        $ns_pos = strrpos($name, "\\");
        if ($ns_pos !== false) {
          $name = substr($name, $ns_pos + 1);
          $out[$name] = $def['urlPath'];
        }

        $def = Shapes::toArray($def);
        $children = idx($def, 'methods');
        if (!is_array($children)) {
          continue;
        }

        foreach ($children as $_ => $child) {
          $name = $child['className'].'::'.$child['name'];
          $out[$name] = $child['urlPath'];
        }
      }
    }
    return $out->toImmMap();
  }

  private function getPHPAPILinks(): ImmMap<string, string> {
    Log::v("\nProcessing PHP.net API Index");

    $index = PHPAPIIndex::getIndex();

    $out = Map { };
    foreach ($index as $name => $data) {
      list($type, $url) = $data;
      $out[$name] = $url;
    }

    return $out->toImmMap();
  }
}
