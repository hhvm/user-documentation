<?hh // strict

namespace HHVM\UserDocumentation;

use namespace Facebook\TypeAssert;

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
    $this->mergeField($new, 'parameters');
    $this->mergeField($new, 'returnType');
    $this->mergeField($new, 'visibility');
    $this->mergeField($new, 'docComment');
    $this->mergeField($new, 'deprecation');

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

      $merged_methods = [];
      foreach ($methods as $method) {
        $name = $method['name'];
        if ($builders->containsKey($name)) {
          $builders[$name]->addData(new Map($method));
        } else {
          $merged_methods[] = $method;
        }
      }

      foreach ($builders as $name => $builder) {
        $merged_methods[] = $builder->build()->toArray();
      }
      $this->data['methods'] = $merged_methods;
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

    if ($key === 'parameters' && $value !== null && $old_value !== null) {
      assert(is_array($value));
      assert(is_array($old_value));
      if (count($value) !== count($old_value)) {
        $name = (string) idx($this->data, 'name', '<unknown>');
        Log::w("\nParameter number mismatch when merging ".$name);
        $num = min(count($value), count($old_value));
      } else {
        $num = count($value);
      }
      for ($i = 0; $i < $num; $i++) {
        self::MergedParameter($value[$i], $old_value[$i]);
      }
    }

    if ($key === 'returnType' && $value !== null && $old_value !== null) {
      // UNSAFE array to shape coercion
      $value = self::MergedTypehint($value, $old_value);
    }

    if ($key === 'deprecation') {
      $value = $old_value ?? $value;
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
    // Try to make the type as specific as possible. object or mixed could
    // be used in something like HNI to represent what might be an int.
    if (Shapes::idx($b, 'typename') !== null) {
      if (strpos($name, 'object') === 0 ||
          strpos($name, 'mixed') === 0) {
        $name = $b['typename'];
      }
    } else if (strpos($b['typename'], $name) !== false &&
               strpos($name, "\\") === false) { // Namespace like \ or HH\
      $name = $b['typename'];
    }

    $generics = $a['genericTypes'];
    if (count($generics) === 0) {
      $generics = $b['genericTypes'];
    }

    $nullable = $a['nullable'] && $b['nullable'];

    // If one of them is nullable and the other mixed
    // we really want the nullable instead of non-null from mixed.
    if (($a['nullable'] || $b['nullable']) &&
        (strpos($a['typename'], 'mixed') !== 0 ^
         strpos($b['typename'], 'mixed') !== 0)) {
      $nullable = true;
    }

    return shape(
      'typename' => $name,
      'nullable' => $nullable,
      'genericTypes' => $generics,
    );
  }

  private static function MergedParameter(
    ?ParameterDocumentation $a,
    ?ParameterDocumentation $b,
  ): ?ParameterDocumentation {
    if ($a === null) {
      return $b;
    }
    if ($b === null) {
      return $a;
    }

    $a_typehint = Shapes::idx($a, 'typehint');
    $b_typehint = Shapes::idx($b, 'typehint');

    $merged_typehint = self::MergedTypehint($a_typehint, $b_typehint);
    return shape(
      'name' => $a['name'],
      'typehint' => $merged_typehint,
      'isVariadic' => $a['isVariadic'] && $b['isVariadic'],
      'isPassedByReference' =>
        $a['isPassedByReference'] && $b['isPassedByReference'],
      'isOptional' => $a['isOptional'] && $b['isOptional'],
      'default' => $a['default'] ?? $b['default'],
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
        $keyed[$key] = TypeAssert\not_null(
          self::MergedTypehint($keyed[$key], $interface)
         );
      } else {
        $keyed[$key] = $interface;
      }
    }
    return array_values($keyed->toArray());
  }
}
