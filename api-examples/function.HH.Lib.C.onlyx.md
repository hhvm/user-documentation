```basic-usage.hack
$string = vec["a"];
$onlyx_result_1 = C\onlyx($string);
echo "First onlyx result: $onlyx_result_1\n";
//Output: First onlyx result: a

$strings = vec["a", "b"];
$onlyx_result_2 = C\onlyx($strings);
//Output: Hit a php exception : exception 'InvariantViolationException' with message
//'Expected exactly one element but got 2.'

$empty_strings = vec[];
$onlyx_result_3 = C\onlyx($empty_strings);
//Output: Hit a php exception : exception 'InvariantViolationException' with message
//'Expected non-empty Traversable.'
```