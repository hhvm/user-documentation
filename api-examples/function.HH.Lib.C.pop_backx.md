```basic-usage.hack
$strings = vec["a", "b"];
$pop_backx_result_1 = C\pop_backx(inout $strings);
echo "First pop_backx result: $pop_backx_result_1\n";
//Output: First pop_backx result: b

$empty_strings = vec[];
$pop_backx_result_2 = C\pop_backx(inout $empty_strings);
//Output: Hit a php exception : exception 'InvariantViolationException' with message 
//'HH\Lib\C\pop_backx: Expected at least one element'
```