```basic-usage.hack
$strings = vec["a", "b", "c", "d"];
$predicate_result_1 = C\findx($strings, $x ==> $x == "a");
echo "First predicate: $predicate_result_1\n";
//Output: First predicate: a

$predicate_result_2 = C\findx($strings, $x ==> $x == "z");
//Output: Hit a php exception : exception 'InvariantViolationException' 
//with message 'HH\Lib\C\findx: Couldn't find target value.'
```