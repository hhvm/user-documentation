```
$items = vec[tuple('foo', 9), tuple('bar', 8), tuple('baz', 7)];
$maxItem = Math\max_by($items, $item ==> $item[1]);
echo "The max item is " . $maxItem[0];
```
Ouput
```
The max item is foo
```
