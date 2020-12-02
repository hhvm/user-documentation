This example shows that `keyExists` returns true if a key exists in the `Shape` (even if the corresponding value is `NULL`):

```basic-usage.php
function run(shape(?'x' => ?int, ?'y' => ?int, ?'z' => ?int) $point): void {
  // The key 'x' exists in Shape $point
  \var_dump(Shapes::keyExists($point, 'x'));

  // The key 'z' doesn't exist in $point
  \var_dump(Shapes::keyExists($point, 'z'));

  // The key 'y' exists in $point, even though its value is NULL
  \var_dump(Shapes::keyExists($point, 'y'));
}

<<__EntryPoint>>
function basic_usage_main(): void {
  run(shape('x' => 3, 'y' => null));
}
```
