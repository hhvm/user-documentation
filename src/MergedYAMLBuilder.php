<?hh // strict

namespace HHVM\UserDocumentation;

final class MergedYAMLBuilder {
  private Map<string, BaseYAML> $definitions = Map { };
  public function __construct(
    private string $destination,
  ) {
  }

  private static function GetMergeKey(BaseYAML $def): string {
    $name = $def['data']['name'];
    $last_ns = strrpos($name, "\\");
    if ($last_ns !== false) {
      $name = substr($name, $last_ns + 1);
    }

    return $def['type'].' '.$name;
  }

  public function build(): void {
    $writer = new YAMLWriter($this->destination);
    foreach ($this->definitions as $def) {
      $writer->write($def);
    }
  }

  public function addDefinition(BaseYAML $def): this {
    $key = self::GetMergeKey($def);
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
