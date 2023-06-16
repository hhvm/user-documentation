```basic-usage.hack
$strings = vec["a", "b", "c"];
$last_string = C\lastx($strings);
echo "Last string in traversable: $last_string \n";
//Output: Last string in traversable: c 

$empty_traversable = vec[];
$last_element = C\lastx($empty_traversable);
//Output: Hit a php exception : exception 'InvariantViolationException' with message
//'HH\Lib\C\lastx: Expected at least one element.'
```
