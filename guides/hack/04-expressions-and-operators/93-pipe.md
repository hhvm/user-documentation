The binary pipe operator, `|>`, evaluates its left-hand operand, and stores the result in the pre-defined *pipe variable* `$$`. There
is a sequence point after the evaluation of the left-hand operand.  Then the right-hand operand is evaluated, and its type and value
become the type and value of the whole expression.  The right-hand operand *must* contain at least one occurrence of the pipe variable `$$`.  For example:

```Hack
$x = vec[2,1,3]
  |> Vec\map($$, $a ==> $a * $a)
  |> Vec\sort($$);
```

A pipe expression *cannot* be used as the right-hand operand of an assignment operator.
