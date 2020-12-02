In this example the `Map`'s values are mapped to the same type (`string`s):

```map-to-strings.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$capitalized = $m->map(fun('strtoupper'));
\var_dump($capitalized);

$css_colors = $capitalized->map($hex_code ==> "color: {$hex_code};");
\var_dump($css_colors);
```

In this example the `Map`'s values are mapped to a different type (`int`s):

```map-to-ints.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$decimal_codes = $m->map(fun('hexdec'));
\var_dump($decimal_codes);
```
