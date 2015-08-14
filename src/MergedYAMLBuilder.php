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

    /* 'Shapes' class not usable in namespaces... */
    /* HH_FIXME[2049] *//* HH_FIXME[4026]*/
    $merged = Shapes::toArray($this->definitions[$key]);
    foreach ($def['sources'] as $source) { $merged['sources'][] = $source; }
    // Use Map to get reference semantics
    $data = new Map($merged['data']);

    // TODO: log warning if any of these are mismatched

    // eg SystemLib defines HH\Traversable, HHI defines \Traversable
    if (strpos($def['data']['name'], "\\") !== false) {
      $data['name'] = $def['data']['name'];
    }

    // eg Systemlib defines Iterable, HHI defines Iterable<Tv>
    self::MergeField(
      $merged,
      $def,
      $in ==> self::ShapeIDX($in['data'], 'generics'),
      $out ==> { $data['generics'] = $out; },
    );

    self::MergeField(
      $merged,
      $def,
      $in ==> self::ShapeIDX($in['data'], 'methods'),
      $out ==> { $data['methods'] = $out; },
    );

    $merged['data'] = $data->toArray();
    $this->definitions[$key] = $merged;
    return $this;
  }

  private static function MergeField<T>(
    BaseYAML $a,
    BaseYAML $b,
    (function(BaseYAML):T) $getter,
    (function(T):void) $setter,
  ): void {
    if ($getter($b) !== null) {
      $val = $getter($b);
    } else {
      $val = $getter($a);
    }
    if ($val !== null) {
      $setter($val);
    }
  }

  private static function ShapeIDX(
    shape() $shape,
    string $field,
  ): mixed {
    /* HH_FIXME[2049] *//* HH_FIXME[4026]*/
    $arr = Shapes::toArray($shape);
    return idx($arr, $field);
  }
}
