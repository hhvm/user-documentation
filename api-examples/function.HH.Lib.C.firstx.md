```basie-usage.hack
$strings = vec["a", "b", "c"];
$first_string = C\firstx($strings);
echo "First string in traversable: $first_string \n";
//Output: First string in traversable: a 

$empty_traversable = vec[];
$first_element = C\firstx($empty_traversable);
//Output: Hit a php exception : exception 'InvariantViolationException' with message
//'HH\Lib\C\firstx: Expected at least one element.' 
```