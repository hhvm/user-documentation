This example shows how to use `Shapes::idx` for keys that may or may not exist in a `Shape`:

```basic-usage.php
function run(shape('x' => int, 'y' => int, ?'z' => int) $point): void {
  // The key 'x' exists in the Shape $point so it's returned
  \var_dump(Shapes::idx($point, 'x'));

  // The key 'z' doesn't exist in $point so the default NULL is returned
  \var_dump(Shapes::idx($point, 'z'));

  // The key 'z' doesn't exist in $point so our explicit default 0 is returned
  \var_dump(Shapes::idx($point, 'z', 0));
}

<<__EntryPoint>>
function basic_usage_main(): void {
  run(shape('x' => 3, 'y' => -1));
}
```

This example shows that `Shapes::idx` will only return the default value if the key doesn't exist in the `Shape`. If the key exists but is `NULL` then `NULL` will be returned.

```nullable-values.php
function runNullable(shape('x' => ?int, 'y' => ?int, ...) $point): void {
  // The key 'x' exists, so its value (3) is returned, not our explicit default 0
  \var_dump(Shapes::idx($point, 'x', 0));

  // The key 'y' exists, so its value (NULL) is returned, not our explicit default 0
  \var_dump(Shapes::idx($point, 'y', 0));
}

<<__EntryPoint>>
function runNullableMain(): void {
  runNullable(shape('x' => 3, 'y' => null));
}
```
