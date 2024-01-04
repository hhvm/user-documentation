```basic-usage.hack
$example_vec = vec[1,2,3,4,5];
$result = Vec\partition($example_vec, $val ==> $val%2 == 0);
print_r($result);
// result: [[2,4], [1,3,5]]

$result = Vec\partition($example_vec, $val ==> $val == $val);
print_r($result);
//result: [[1,2,3,4,5], []]

$result = Vec\partition($example_vec, $val ==> $val != 0);
print_r($result);
//result: [[1,2,3,4,5], []]
```