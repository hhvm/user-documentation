This example shows that `items()` returns an `Iterable` view of the `Vector`. The `Iterable` will produce the values of the `Vector` at the time it's iterated.

```basic-usage.php
<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get an Iterable view of the Vector
  $iterable = $v->items();

  // Add another color to the original Vector $v
  $v->add('purple');

  // Print each color using $iterable
  foreach ($iterable as $color) {
    echo $color."\n";
  }
}

// This wouldn't work because the Iterable interface is read-only:
// $iterable->add('orange');
```
