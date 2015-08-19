<?hh

namespace HHVM\UserDocumentation;

final class MergedDataBuilder {
  private Map<string, mixed> $data;
  public function __construct(
    \ConstMap<string, mixed> $initial,
  ) {
    $this->data = $initial->toMap();
  }

  public function addData(\ConstMap<string, mixed> $new): this {
    $this->mergeField($new, 'generics');
    $this->mergeField($new, 'methods');
    $this->mergeField($new, 'docComment');

    $p1 = idx($this->data, 'parent');
    $p2 = idx($new, 'parent');
    if ($p1 === null || $p2 === null) {
      $parent = ($p1 !== null) ? $p1 : $p2;
    } else {
      // UNSAFE mixed to shape coercion
      $parent = self::MergedTypehint($p1, $p2);
    }
    if ($parent !== null) {
      $this->data['parent'] = $parent;
    }

    $interfaces = new Vector(/*UNSAFE_EXPR*/idx($this->data, 'interfaces', []));
    $interfaces->addAll(/*UNSAFE_EXPR*/idx($new, 'interfaces', []));
    if ($interfaces) {
      $this->data['interfaces'] = self::MergedInterfaces($interfaces);
    }
    return $this;
  }

  public function build(): Map<string, mixed> {
    return $this->data;
  }

  private function mergeField(\ConstMap<string, mixed> $new, string $key): void {
    if (!$new->containsKey($key)) {
      return;
    }

    $value = $new[$key];
    if ($value !== null && $value != []) {
      $this->data[$key] = $value;
    }
  }

  private static function MergedTypehint(
    ?TypehintDocumentation $a,
    ?TypehintDocumentation $b,
  ): ?TypehintDocumentation {
    if ($a === null) {
      return $b;
    }
    if ($b === null) {
      return $a;
    }

    $name = $a['typename'];
    if (strpos($name, "\\") === false) {
      $name = $b['typename'];
    }
    $generics = $a['genericTypes'];
    if (count($generics) === 0) {
      $generics = $b['genericTypes'];
    }

    return shape(
      'typename' => $name,
      'genericTypes' => $generics,
    );
  }

  private static function MergedInterfaces(
    \ConstVector<TypehintDocumentation> $interfaces,
  ): array<TypehintDocumentation> {
    $keyed = Map { };
    foreach ($interfaces as $interface) {
      $name = $interface['typename'];
      $ns_sep = strrpos($name, "\\");
      if ($ns_sep === false) {
        $key = $name;
      } else {
        $key = substr($name, $ns_sep + 1);
      }
      if ($keyed->containsKey($key)) {
        $keyed[$key] = self::MergedTypehint($keyed[$key], $interface);
      } else {
        $keyed[$key] = $interface;
      }
    }
    return array_values($keyed->toArray());
  }
}
