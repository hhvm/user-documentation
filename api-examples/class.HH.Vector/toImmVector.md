This example shows that `toImmVector` returns an immutable copy of the `Vector`. Mutating the original `Vector` doesn't affect the immutable copy.

```basic-usage.php
function expects_immutable(ImmVector<mixed> $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get a deep, immutable copy of $v
  $immutable_v = $v->immutable();

  // Add a color to the original Vector $v
  $v->add('purple');

  expects_immutable($immutable_v);
}
```
