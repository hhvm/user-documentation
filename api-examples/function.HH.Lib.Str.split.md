```basic-usage.hack
$str = "This, is, a, great, software, for sure.";
$split_str = Str\split($str, ",");
\print_r($split_str);

$split_str2 = Str\split($str, ",", 3);
\print_r($split_str2);
```
