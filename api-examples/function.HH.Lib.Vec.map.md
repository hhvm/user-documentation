```basic-usage.hack
$numbers = vec[1, 2, 3];
$new_numbers = Vec\map($numbers, $number ==> ($number + 1));
echo "new numbers are: \n";
\print_r($new_numbers);
//Output: new numbers are: 
//vec[2, 3, 4]
```