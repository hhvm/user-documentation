```basie-usage.hack
$strings = vec["a", "b", "c"];
$first_string = C\nfirst($strings);
echo "First string in traversable: $first_string \n";
//Output: First string in traversable: a 

$empty_traversable = vec[];
$first_element = C\nfirst($empty_traversable);
$first_element_as_string = $first_element ?? "null";
echo "First element in empty traversable: $first_element_as_string";
//Output: First element in empty traversable: null
```
