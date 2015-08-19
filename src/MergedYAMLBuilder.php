<?hh // strict

namespace HHVM\UserDocumentation;

final class MergedYAMLBuilder {
  private Map<string, BaseYAML> $definitions = Map { };
  public function __construct(
    private string $destination,
  ) {
  }

  private static function GetMergeKey(string $type, string $name): string {
    if ($type === 'interface' || $type === 'trait') {
      $type === 'class';
    }

    $last_ns = strrpos($name, "\\");
    if ($last_ns !== false) {
      $name = substr($name, $last_ns + 1);
    }

    return $type.' '.$name;
  }

  public function build(): void {
    $this->normalizeAll();

    $writer = new YAMLWriter($this->destination);
    foreach ($this->definitions as $def) {
      $writer->write($def);
    }
  }

  private function normalizeAll(): void {
    static $called = false;
    invariant(!$called, 'normalizeAll called twice');
    $called = true;

    foreach ($this->definitions as $key => $def) {
      $parent = $this->getParent($def);
      if ($parent !== null) {
        $def['parent'] = $this->normalizeType($parent);
      }
      $interfaces = $this->getInterfaces($def);
      if ($interfaces !== null) {
        $def['interfaces'] = array_map(
          $interface ==> $this->normalizeType($interface),
          $interfaces,
        );
      }
      $this->definitions[$key] = $def;
    }
  }

  private function normalizeType(
    TypehintDocumentation $type,
  ): TypehintDocumentation {
    $name = $type['typename'];
    $key = self::GetMergeKey('class', $name);
    $matches = $this->definitions->containsKey($key);
    if (!$matches) {
      $matches = preg_match('^/T[a-z0-9][A-Za-z0-9]*$/', $name);
    }
    invariant(
      $matches,
      'could not find definition for %s',
      $key,
    );
    $canonical = $this->definitions->at($key);
    return shape(
      'typename' => $canonical['data']['name'],
      'genericTypes' => array_map(
        $t ==> /* UNSAFE_EXPR */ $this->normalizeType($t),
        $type['genericTypes'],
      ),
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

  private function getParent(BaseYAML $def): ?TypehintDocumentation {
    // UNSAFE
    return idx(Shapes::toArray($def), 'parent');
  }

  private function getInterfaces(BaseYAML $def): ?array<TypehintDocumentation> {
    // UNSAFE
    return idx(Shapes::toArray($def), 'interfaces');
  }
}
