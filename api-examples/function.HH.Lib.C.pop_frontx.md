```basic-usage.hack
$strings = vec["a", "b"];
$pop_frontx_result_1 = C\pop_frontx(inout $strings);
echo "First pop_frontx result: $pop_frontx_result_1\n";
//Output: First pop_frontx result: a

$empty_strings = vec[];
$pop_frontx_result_2 = C\pop_frontx(inout $empty_strings);
//Output: Hit a php exception : exception 'InvariantViolationException' with message
//'HH\Lib\C\pop_frontx: Expected at least one element'
```
