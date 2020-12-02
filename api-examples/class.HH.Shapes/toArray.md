This example shows that `toArray` will return the underlying array of a `Shape`. The result will be loosely typed because a single `Shape` can contain arbitrary different types (e.g. `string`, `int`, `float`).

```basic-usage.php
$point = shape('name' => 'Jane Doe', 'age' => 55, 'points' => 25.30);
\var_dump(Shapes::toArray($point));
```
