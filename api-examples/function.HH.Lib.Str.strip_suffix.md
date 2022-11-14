```basic-usage.hack
$input = "\$100 USD";
$result = Str\strip_suffix($input, "USD");
echo "Strip suffix from $input : $result \n";

