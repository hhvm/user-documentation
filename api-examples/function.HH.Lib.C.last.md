```basic-usage.hack
$strings = vec["a", "b", "c"];
$last_string = C\last($strings);
echo "Last string in traversable: $last_string \n";

$empty_traversable = vec[];
$last_element = C\last($empty_traversable);
$last_element_as_string = $last_element ? $last_element : "null";
echo "Last element in empty traversable: $last_element_as_string";
```
