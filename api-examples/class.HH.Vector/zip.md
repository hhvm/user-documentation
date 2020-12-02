This example shows how `zip` combines the values of the `Vector` and another `Traversable`. The resulting `Vector` `$labeled_colors` has three elements because `$labels` doesn't have a fourth element to pair with `$v`.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

$labels = Vector {'My Favorite', 'My 2nd Favorite', 'My 3rd Favorite'};
$labeled_colors = $v->zip($labels);

\var_dump($labeled_colors->count()); // 3

foreach ($labeled_colors as list($color, $label)) {
  echo $label.': '.$color."\n";
}
```
