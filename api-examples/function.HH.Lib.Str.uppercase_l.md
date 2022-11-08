```basic-usage.hack
$locale = \HH\Lib\Locale\create("en_US.UTF-8");
$uppercase_string = Str\uppercase_l($locale, 'ifoo');
echo "Get uppercase string with en_US.UTF-8: $uppercase_string \n";
