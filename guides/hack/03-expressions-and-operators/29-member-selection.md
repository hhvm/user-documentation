The operator `->` is used to access instance properties and instance
methods on objects.

```IntBox.hack no-auto-output
class IntBox {
  private int $x;

  public function __construct(int $x) {
    $this->x = $x; // Assigning to property.
  }

  public function getX(): int {
    return $this->x; // Accessing property.
  }
}

<<__EntryPoint>>
function main(): void {
  $ib = new IntBox(42);
  $x = $ib->getX(); // Calling instance method.
}
```

## Null Safe Member Access

The operator `?->` allows access to objects that [may be null](../types/nullable-types.md).

If the value is null, the result is null. Otherwise, `?->` behaves
like `->`.

``` Hack
function my_example(?IntBox $ib): ?int {
  return $ib?->getX();
}
```

Note that arguments are always evaluated, even if the object is
null. `$x?->foo(bar())` will call `bar()` even if `$x` is null.

## XHP Attribute Access

The [operator `->:`](/hack/expressions-and-operators/attribute-selection) is used for accessing XHP attributes.
