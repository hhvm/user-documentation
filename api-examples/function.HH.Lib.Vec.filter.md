```basic-usage.hack
$numbers = vec[1, 2, 3, 4, 5];
$filter_numbers = Vec\filter($numbers, $number ==> $number % 2 === 0);
echo "Filter numbers are: \n";
\print_r($filter_numbers);
//Output: Filter numbers are:
//vec[2, 4]
```
