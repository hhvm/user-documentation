```basic-usage.hack
$comparison_1 = Str\compare("apple", "banana");
echo "Result of first comparison: $comparison_1 \n";

$comparison_2 = Str\compare("banana", "apple");
echo "Result of second comparison: $comparison_2 \n";

$comparison_3 = Str\compare("apple", "apple");
echo "Result of third comparison: $comparison_3 \n";

$comparison_4 = Str\compare("apple", "Apple");
echo "Result of fourth comparison: $comparison_4 \n";
```
