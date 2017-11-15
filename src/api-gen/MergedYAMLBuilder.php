<?hh // strict

namespace HHVM\UserDocumentation;

final class MergedYAMLBuilder {
  private Map<string, BaseYAML> $definitions = Map { };
  public function __construct(
    private string $destination,
  ) {
  }

  private static function GetMergeKey(
    APIDefinitionType $type,
    string $name,
  ): string {
    if (
      $type === APIDefinitionType::INTERFACE_DEF
      || $type === APIDefinitionType::TRAIT_DEF
    ) {
      $type === APIDefinitionType::CLASS_DEF;
    }

    $last_ns = strrpos($name, "\\");
    if ($last_ns !== false) {
      $name = substr($name, $last_ns + 1);
    }

    return $type.' '.$name;
  }

  public function build(): void {
    $writer = new YAMLWriter($this->destination);
    foreach ($this->definitions as $def) {
      // UNSAFE ($def['data']['methods'] is not defined on the shape)
      if ($methods = idx($def['data'], 'methods')) {
        $methods = $this->removePrivateMethods(/*UNSAFE_EXPR*/ $methods);
        foreach ($methods as $k => $method) {
          $method['className'] = $def['data']['name'];
          $methods[$k] = $method;
        }
        usort(
          $methods,
          // ($a, $b) ==> $a['name'] <=> $b['name'], - SOON :D
          ($a, $b) ==> strcmp($a['name'], $b['name']),
        );
        $def['data']['methods'] = $methods;
      }
      $writer->write($def);
    }
  }

  private function removePrivateMethods<T as shape('visibility' => string, ...)>(
    array<T> $methods,
  ): array<T> {
    // We filter out private methods at this late stage as occassionally we have
    // inconsistent ideas of what the visibility is and we want to go for the
    // most restrictive - if we filter out before merge, we'll end up with public
    // or protected, but if it says private anywhere we want to ignore those and
    // just not document the method
    return array_filter(
      $methods,
      $method ==> $method['visibility'] !== 'private',
    );
  }

  public function addDefinition(BaseYAML $def): this {
    $key = self::GetMergeKey($def['type'], $def['data']['name']);
    if (!$this->definitions->containsKey($key)) {
      $this->definitions[$key] = $def;
      return $this;
    }

    $merged = $this->definitions[$key];
    foreach ($def['sources'] as $source) { $merged['sources'][] = $source; }

    // eg SystemLib defines HH\Traversable, HHI defines \Traversable
    if (strpos($def['data']['name'], "\\") !== false) {
      $merged['data']['name'] = $def['data']['name'];
    }

    $merged_data = StringKeyedShapes::toMap($merged['data']);
    $new_data = StringKeyedShapes::toMap($def['data']);

    $merged['data'] = (new MergedDataBuilder($merged_data))
      ->addData($new_data)
      ->build()->toArray();

    // UNSAFE array to shape conversion
    $this->definitions[$key] = $merged;
    return $this;
  }
}
