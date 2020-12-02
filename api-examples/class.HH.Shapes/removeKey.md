This example shows that `removeKey` directly removes a key from a `Shape`:

```basic-usage.php
function run(shape('x' => int, 'y' => int) $point): void {
  // Prints the value at key 'y'
  \var_dump($point['y']);

  Shapes::removeKey(inout $point, 'y');

  // Prints NULL because the key 'y' doesn't exist any more
  /* HH_IGNORE_ERROR[4251] typechecker knows the key doesn't exist */
  \var_dump(Shapes::idx($point, 'y'));
}

<<__EntryPoint>>
function basic_usage_main(): void {
  run(shape('x' => 3, 'y' => -1));
}
```
