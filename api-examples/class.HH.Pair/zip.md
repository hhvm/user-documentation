```basic-usage.php
$p = Pair {'foo', -1.5};

$labels = Vector {'First Value', 'Second Value'};
$labeled = $p->zip($labels);

foreach ($labeled as list($value, $label)) {
  echo $label.': '.(string)$value."\n";
}
```
