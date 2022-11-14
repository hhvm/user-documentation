```basic-usage.hack
$locale = \HH\Lib\Locale\create("en_US.UTF-8");
$result = Str\splice_l($locale, "apple", "orange", 5, 0);
echo "Splice string with en_US.UTF-8: $result \n";
