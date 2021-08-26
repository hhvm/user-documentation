The binary pipe operator, `|>`, evaluates the result of a left-hand expression and stores the result in `$$`, the pre-defined pipe variable. The right-hand expression *must* contain at least one occurrence of `$$`.

For example, the code below ...

``` Hack
$x = vec[2,1,3]
  |> Vec\map($$, $a ==> $a * $a) // $$ with value [2,1,3]
  |> Vec\sort($$); // $$ with value [4,1,9]
```

... is functionally equivalent to:

``` Hack
Vec\sort(Vec\map(vec[2, 1, 3], $a ==> $a * $a)) // Evaluates to vec[1,4,9]
```
