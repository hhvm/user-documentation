This example shows how `mapWithKey` can be used to create a new `Vector` based on `$v`'s keys and values:

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

$sentences = $v->mapWithKey(($index, $color) ==> "Color at {$index}: {$color}");

echo \implode("\n", $sentences)."\n";
```
