<?hh // strict

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
    $this->mergeField($new, 'visibility');
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
    $data = clone $this->data;
    return $this->data;
  }

  private function mergeField(\ConstMap<string, mixed> $new, string $key): void {
    if (!$new->containsKey($key)) {
      return;
    }

    $value = $new[$key];

    if ($key === 'methods') {
      assert(is_array($value));

      $builders = Map { };
      $methods = [];

      foreach ($value as $method) {
        $builders[$method['name']] = (new MergedDataBuilder(new Map($method)));
      }
      $methods = idx($this->data, 'methods', []);
      assert(is_array($methods));
      foreach ($methods as $method) {
        $name = $method['name'];
        if ($builders->containsKey($name)) {
          $builders[$name]->addData(new Map($method));
        } else {
          $methods[] = $method;
        }
      }

      foreach ($builders as $name => $builder) {
        $methods[] = $builder->build()->toArray();
      }
      $this->data['methods'] = $methods;
      return;
    }

    $old_value = idx($this->data, $key);
    if ($key === 'visibility' && $value !== null && $old_value !== null) {
      $map = Map {
        'public' => 0,
        'protected' => 1,
        'private' => 2,
      };

      // Pick the most restrictive
      $old_value = $map[$old_value];
      $value = max($old_value, $map[$value]);
      $value = $map->keys()[$value];
    }


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
        $keyed[$key] = ArgAssert::isNotNull(
          self::MergedTypehint($keyed[$key], $interface)
         );
      } else {
        $keyed[$key] = $interface;
      }
    }
    return array_values($keyed->toArray());
  }
}
