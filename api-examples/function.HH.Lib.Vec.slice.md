```basic-usage.hack
$vector = vec[1, 2, 3, 4, 5, 6, 7];
$sliced_vector = Vec\slice($vector, 3);
\print_r($sliced_vector);

$sliced_vector2 = Vec\slice($vector, 2, 3);
\print_r($sliced_vector2);
```
